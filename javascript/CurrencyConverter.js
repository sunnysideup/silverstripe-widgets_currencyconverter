 jQuery(document).ready (
  function () {
   jQuery("#CurrencyConverterSubmit").click(
    function() {
     jQuery("#CurrencyConverterConvertedAmount").text("Loading new data . . .");
     var url = 'CurrencyConverterWidget_Controller/getRate/';
     var from = jQuery("#CurrencyConverterFromCurrencyCode").val();
     if(!from) {
      jQuery("#CurrencyConverterConvertedAmount").text("please select a currency to convert FROM.");
      jQuery("#CurrencyConverterFromCurrencyCode").focus();
      return false;
     }
     var to = jQuery("#CurrencyConverterToCurrencyCode").val();
     if(!to) {
      jQuery("#CurrencyConverterConvertedAmount").text("please select a currency to convert TO.");
      jQuery("#CurrencyConverterToCurrencyCode").focus();
      return false;
     }
     if(to == from) {
      jQuery("#CurrencyConverterConvertedAmount").text("please make sure that the FROM currency is NOT the same as the TO currency");
      jQuery("#CurrencyConverterToCurrencyCode").focus();
      return false;
     }
     var amount = jQuery("#CurrencyConverterAmount").val();
     if(!amount || amount < 1) {
      jQuery("#CurrencyConverterConvertedAmount").text("please select an amount to convert.");
      jQuery("#CurrencyConverterAmount").focus();
      return false;
     }
     jQuery.get(url, {f : from, t : to, a : amount },
      function(data) {
       if(!data) {
        jQuery("#CurrencyConverterConvertedAmount").text("Sorry, we could not find any exchange rate.");
        return false;
       }
       jQuery("#CurrencyConverterConvertedAmount").text(data);
      }
     );
     return false;
    }
   );
  }
 );
