<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Auth;
use View;
use Validator;
use Session;
use Redirect;
use Input;
use DB;
use App\Budget;
use App\Briefing;
use App\BudgetType;
use App\BudgetVersion;

class BudgetController extends Controller
{

	private function loadBudgetsData($budgetId,$masterBriefingId,$activeTab) {
		$isAdding = true;
		if (!isset($activeTab))
			$activeTab = "#list";
		$masterBriefingId = isset($masterBriefingId)?$masterBriefingId:-1;
		$masterBriefing = null;
		$versionNumber = 1;
		$lastVersionDate = null;
		$nextBudgetId = 1;
		$budgets = null;
		//DB::select( DB::raw("SELECT * FROM some_table WHERE some_col = '$someVariable'")); // Incorrect way
		//DB::select( DB::raw("SELECT * FROM some_table WHERE some_col = :somevariable"), array('somevariable' => $someVariable,)); // Safe way
		$lastBudgetId = DB::select(DB::raw("SELECT AUTO_INCREMENT AS nextId FROM information_schema.TABLES WHERE (TABLE_NAME = 'budgets')"));
		if (isset($lastBudgetId))
			$nextBudgetId = $lastBudgetId[0]->nextId;
		if ($masterBriefingId > 0) {
			$budgets = Budget::where('briefing_id',$masterBriefingId)->orderBy('date_budget','DESC')->orderBy('created_at','DESC')->get();
			$masterBriefing = Briefing::find($masterBriefingId);
		} else {
			$budgets = Budget::orderBy('date_budget','DESC')->orderBy('created_at','DESC')->get();
		}
		$budgetTypes = BudgetType::orderBy('id','ASC')->get();
		
		$addEditTitleLabel = trans('budgets.add');
		
		$relationships = array('budgetTypes' => $budgetTypes);
		
		if (isset($budgetId)) {
			$isAdding = false;
			$addEditTitleLabel = trans('budgets.edit');
			$budgetToEdit = Budget::find($budgetId);
			if (!$budgetToEdit) {
				return Redirect::to(route('get_budgets'));
			} else {
				$versionNumber = $budgetToEdit->budgetVersionCount();
				$lastVersionDate = $budgetToEdit->budgetVersions->last()->date_budget_version;
				return View::make('pages.budgets.index')->with('isAdding', $isAdding)->with('activeTab', $activeTab)->with('addEditTitleLabel', $addEditTitleLabel)->with('budgets', $budgets)->with('relationships', $relationships)->with('budgetToEdit', $budgetToEdit)->with('masterBriefingId', $masterBriefingId)->with('masterBriefing', $masterBriefing)->with('nextBudgetId', $nextBudgetId)->with('versionNumber', $versionNumber)->with('lastVersionDate', $lastVersionDate);
			}
		} else {
			return View::make('pages.budgets.index')->with('isAdding', $isAdding)->with('activeTab', $activeTab)->with('addEditTitleLabel', $addEditTitleLabel)->with('budgets', $budgets)->with('relationships', $relationships)->with('masterBriefingId', $masterBriefingId)->with('masterBriefing', $masterBriefing)->with('nextBudgetId', $nextBudgetId)->with('versionNumber', $versionNumber)->with('lastVersionDate', $lastVersionDate);
		}
	}
	
    /**
     * Show us all the budgets of the App
     */
    public function showBudgets()
    {
    	$masterBriefingId = Input::get('masterBriefingId');
    	if (!isset($masterBriefingId))
    		$masterBriefingId = Session::get('masterBriefingId');
		return $this->loadBudgetsData(null,$masterBriefingId,Input::get('activeTab'));
    }

    /**
     * Add/Update a budget for the current user.
     */
    public function addUpdateBudget()
    {
    	
    	$not_in = "-1";
    	$not_in_usual = "-1,0";
    	
    	$rules = array(
    		'newDateBudgetVersion' => 'date|date_after_or_equal:dateBudget,lastVersionDateOriginal',
    	 	'dateBudget' => 'required|date|date_before_or_equal:lastVersionDateOriginal,newDateBudgetVersion',
    		'budgetType' => 'required|not_in:'.$not_in_usual,
    		'total' => 'required|numeric',
    		'rejected' => 'required|not_in:'.$not_in,
    		'rejectedReason' => 'required_if:rejected,2',
    		'closed' => 'boolean'
    	 );
        
        $validator = Validator::make(Input::all(), $rules);
        
        $briefingId = Input::get('idBriefingRec');
        
        if ($validator->fails()) {
            return Redirect::to(route('get_budgets'))
                ->withErrors($validator->errors())
                ->withInput(Input::all())->with('masterBriefingId', $briefingId);
        }
        
        $messageSuccesful = trans('budgets.recAdded');
        
        $budgetId = Input::get('idRec');
        $newDateBudgetVersion = Input::get('newDateBudgetVersion');
        $dateBudget = Input::get('dateBudget');
        $budgetType = Input::get('budgetType');
        $total = Input::get('total');
        $rejected = Input::get('rejected');
        $rejectedReason = Input::get('rejectedReason');
        $closed = 0;
                
        $user = Auth::user();
        
        $budget = new Budget();
        $budget->user_id = $user->id;
        $budget->briefing_id = $briefingId;
        if ($budgetId !== '*') {
        	$budget = Budget::find($budgetId);
        	$messageSuccesful = trans('budgets.recEdited');
        } else {
        	$newDateBudgetVersion = $dateBudget;
        }
        $budget->last_updated_user_id = $user->id;
        $budget->date_budget = $dateBudget;        
        $budget->budget_type_id = $budgetType;
        $budget->total = $total;
        $budget->rejected = $rejected;
        $budget->rejected_reason = $rejectedReason;
        $budget->closed = $closed;
        
        $budget->save();
        
        if (!empty($newDateBudgetVersion)) {
        	$budgetVersion = new BudgetVersion();
        	$budgetVersion->user_id = $user->id;
        	$budgetVersion->last_updated_user_id = $user->id;
        	$budgetVersion->budget_id = $budget->id;
        	$budgetVersion->date_budget_version = $newDateBudgetVersion;
        	$budgetVersion->save();
        }
        
        return Redirect::to(route('get_budgets'))->with('message', $messageSuccesful)->with('masterBriefingId', $briefingId);
    }

    /**
     * Delete a budget
     */
    public function deleteBudget()
    {
        $budget = Budget::find(Input::get('id'));

        if (!$budget) {
            return Redirect::to(route('get_budgets'));
        }
        
        if ($budget->rejected > 0)
        	return Redirect::to(route('get_budgets'))->withErrors(trans('validation.budgets.rejectedAccepted'));

        $budget->delete();

        return Redirect::to(route('get_budgets'))->with('message', trans('budgets.recDeleted'))->with('masterBriefingId', Input::get('masterBriefingId'));
    }
    
    /**
     * Load data to edit a budget
     */
    public function loadToEditBudget()
    {
		return $this->loadBudgetsData(Input::get('idRecToEdit'),Input::get('idBriefingRecToEdit'),Input::get('activeTab'));
    }

}
