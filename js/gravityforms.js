gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
  if ( formId == 8 && fieldId == 4 ) {
    optionsObj.minDate = 0;
    optionsObj.onClose = function (dateText, inst) {
      dateText = new Date(dateText);
      dateMin = new Date(dateText.getFullYear(), dateText.getMonth() + 0,dateText.getDate());
      jQuery('#input_8_5').datepicker('option', 'minDate', dateMin).datepicker('setDate', dateMin);
    };
  }
  return optionsObj;
});

gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
  if ( formId == 9 && fieldId == 4 ) {
    optionsObj.minDate = 0;
    optionsObj.onClose = function (dateText, inst) {
      dateText = new Date(dateText);
      dateMin = new Date(dateText.getFullYear(), dateText.getMonth() + 0,dateText.getDate());
      jQuery('#input_9_5').datepicker('option', 'minDate', dateMin).datepicker('setDate', dateMin);
    };
  }
  return optionsObj;
});

gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
  if ( formId == 10 && fieldId == 5 ) {
    optionsObj.minDate = 0;
    optionsObj.onClose = function (dateText, inst) {
      dateText = new Date(dateText);
      dateMin = new Date(dateText.getFullYear(), dateText.getMonth() + 0,dateText.getDate());
      jQuery('#input_10_6').datepicker('option', 'minDate', dateMin).datepicker('setDate', dateMin);
    };
  }
  return optionsObj;
});

gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
  if ( formId == 11 && fieldId == 5 ) {
    optionsObj.minDate = 0;
    optionsObj.onClose = function (dateText, inst) {
      dateText = new Date(dateText);
      dateMin = new Date(dateText.getFullYear(), dateText.getMonth() + 0,dateText.getDate());
      jQuery('#input_11_6').datepicker('option', 'minDate', dateMin).datepicker('setDate', dateMin);
    };
  }
  return optionsObj;
});

gform.addFilter( 'gform_datepicker_options_pre_init', function( optionsObj, formId, fieldId ) {
  if ( formId == 13 && fieldId == 5 ) {
    optionsObj.minDate = 0;
    optionsObj.onClose = function (dateText, inst) {
      dateText = new Date(dateText);
      dateMin = new Date(dateText.getFullYear(), dateText.getMonth() + 0,dateText.getDate());
      jQuery('#input_13_6').datepicker('option', 'minDate', dateMin).datepicker('setDate', dateMin);
    };
  }
  return optionsObj;
});
