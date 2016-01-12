<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

	'accepted'       => 'El campo :attribute debe ser aceptado.',
	'active_url'     => 'El campo :attribute no es una URL válida.',
	'after'          => 'El campo :attribute debe ser una fecha después de :date.',
	'alpha'          => 'El campo :attribute sólo puede contener letras.',
	'alpha_dash'     => 'El campo :attribute sólo puede contener letras, números y guiones.',
	'alpha_num'      => 'El campo :attribute sólo puede contener letras y números.',
	'array'          => 'El campo :attribute debe ser una matriz.',
	'before'         => 'El campo :attribute debe ser una fecha antes :date.',
	'between'        => array(
			'numeric' => 'El campo :attribute debe estar entre :min - :max.',
			'file'    => 'El campo :attribute debe estar entre :min - :max kilobytes.',
			'string'  => 'El campo :attribute debe estar entre :min - :max carácteres.',
			'array'   => 'El campo :attribute debe tener entre :min y :max elementos.',
	),
	'boolean'        => 'El campo :attribute debe ser verdadero o false.',
	'confirmed'      => 'El campo de confirmación de :attribute no coincide.',
	'date'           => 'El campo :attribute no es una fecha válida.',
	'date_format' 	 => 'El campo :attribute no corresponde con el formato :format.',
	'different'      => 'Los campos :attribute y :other deben ser diferentes.',
	'digits'         => 'El campo :attribute debe ser de :digits dígitos.',
	'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
	'email'          => 'El formato del :attribute es inválido.',
	'exists'         => 'El campo :attribute seleccionado es inválido.',
	'filled'         => 'El campo :attribute es obligatorio.',
	'image'          => 'El campo :attribute debe ser una imagen.',
	'in'             => 'El valor seleccionado para el campo :attribute es inválido.',
	'integer'        => 'El campo :attribute debe ser un entero.',
	'ip'             => 'El campo :attribute debe ser una dirección IP válida.',
	'json'           => 'El campo :attribute debe tener un formato JSON válido.',
	'max'            => array(
			'numeric' => 'El campo :attribute debe ser menor que :max.',
			'file'    => 'El campo :attribute debe ser menor que :max kilobytes.',
			'string'  => 'El campo :attribute debe ser menor que :max carácteres.',
			'array'   => 'El campo :attribute debe tener al menos :min elementos.',
		),
	'mimes'         => 'El campo :attribute debe ser un archivo de tipo :values.',
	'min'           => array(
			'numeric' => 'El campo :attribute debe tener al menos :min.',
			'file'    => 'El campo :attribute debe tener al menos :min kilobytes.',
			'string'  => 'El campo :attribute debe tener al menos :min carácteres.',
	),
	'not_in'             	=> 'El valor seleccionado para el campo :attribute es inválido.',
	'numeric'               => 'El campo :attribute debe ser un número.',
	'regex'                 => 'El formato del campo :attribute es inválido.',
	'required'              => 'El campo :attribute es obligatorio.',
	//'required_if'           => 'El campo :attribute es obligatorio cuando el valor del campo :other es :value.',
	'required_if'           => 'El campo :attribute es obligatorio cuando el valor del campo :other es el seleccionado.',
	'required_with'         => 'El campo :attribute es obligatorio cuando los valores :values están presentes.',
	'required_with_all'     => 'El campo :attribute es obligatorio cuando los valores :values están presentes.',
	'required_without'      => 'El campo :attribute es obligatorio cuando los valore :values no están presentes.',
	'required_without_all'  => 'El campo :attribute es obligatorio cuando ningún :values está presente.',
	'same'                  => 'El campo :attribute y :other debe coincidir.',
	'size'                  => array(
			'numeric' => 'El campo :attribute debe ser :size.',
			'file'    => 'El campo :attribute debe tener :size kilobytes.',
			'string'  => 'El campo :attribute debe tener :size carácteres.',
			'array'   => 'El campo :attribute debe contener :size elementos.',
	),
	'string'          => 'El campo :attribute debe ser alfanumérico.',
	'timezone'        => 'El campo :attribute debe de ser de una zona horaria válida.',
	'unique' => 'El campo :attribute ya ha sido tomado.',
	'url'    => 'El formato de :attribute es inválido.',
	'date_after_or_equal' => 'El campo :attribute debe ser una fecha mayor o igual a las comparadas',
	'date_before_or_equal' => 'El campo :attribute debe ser una fecha menor o igual a las comparadas',
		
	'briefings.linkedBudgets' => 'El briefing seleccionado no se ha podido borrar ya que tiene propuestas asociadas.',
	'budgets.rejectedAccepted' => 'La propuesta seleccionada no se ha podido borrar ya que ha sido aceptada/denegada.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
		'newDateBudgetVersion' => [
    		'date_after_or_equal' => 'El campo :attribute debe ser mayor o igual que la fecha de la propuesta y la fecha de la versión actual.'
    	],
    	'dateBudget' => [
    		'date_before_or_equal' => 'El campo :attribute debe ser menor o igual que las fechas de la versión y/o nueva versión.'
    	]
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
    	'dateBriefing' => trans('briefings.dateBriefing'),
    	'customer' => trans('briefings.customer'),
    	'customerType' => trans('briefings.customerType'),
    	'contact' => trans('briefings.contact'),
    	'product' => trans('briefings.product'),
    	'iolProduct' => trans('briefings.iolProduct'),
    	'briefingSource' => trans('briefings.source'),
    	'briefingOwner' => trans('briefings.owner'),
    	'challenge' => trans('briefings.challenge'),
    	'closed' => trans('briefings.closed'),
    	'newDateBudgetVersion' => trans('budgets.newDateBudgetVersion'),
		'dateBudget' => trans('budgets.dateBudget'),
    	'budgetType' => trans('budgets.budgetType'),
    	'total' => trans('budgets.total'),
    	'rejected' => trans('budgets.rejected'),
    	'rejectedReason' => trans('budgets.rejectedReason')
    ]

];