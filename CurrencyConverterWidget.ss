

<form method="post" action="#">
 <div id="converter">
  <div id="converterTop"></div>

  <div id="CurrencyConverterAmountHolder" class="CurrencyConverterHolder">
   <label for="CurrencyConverterAmount">convert this amount</label>
   <input type="text" name="CurrencyConverterAmount" value="$getAmount" id="CurrencyConverterAmount" />
   <span class="CurrencyConverterBelowInput">enter any amount</span>
  </div>

  <div id="CurrencyConverterFromHolder" class="CurrencyConverterHolder">
   <label for="CurrencyConverterFromCurrencyCode">from this currency</label>
   <select name="CurrencyConverterFromCurrencyCode" size="1" id="CurrencyConverterFromCurrencyCode">
<% control Currencies %>
    <option value="$code" <% if currentFrom %>selected="selected"<% end_if %>>$name</option>
<% end_control %>
$currentFrom,
   </select>
   <span class="CurrencyConverterBelowSelect">scroll down to see more currencies</span>
  </div>

  <div id="CurrencyConverterToHolder" class="CurrencyConverterHolder">
   <label for="CurrencyConverterToCurrencyCode">into currency</label>
   <select name="CurrencyConverterToCurrencyCode" size="1" id="CurrencyConverterToCurrencyCode">
<% control Currencies %>
    <option value="$code" <% if currentTo %>selected="selected"<% end_if %>>$name</option>
<% end_control %>
   </select>
   <span class="CurrencyConverterBelowSelect">scroll down to see more currencies</span>
  </div>

  <div id="CurrencyConverterSubmitHolder" class="CurrencyConverterHolder">
   <input id="CurrencyConverterSubmit" name="CurrencyConverterSubmit" value="click here to perform currency conversion" type="button"  />
   <span id="CurrencyConverterConvertedAmount">$getExchangedAmount</span>
  </div>

  <div id="converterBottom"></div>
 </div>
</form>

