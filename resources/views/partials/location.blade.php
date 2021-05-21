<option value=""></option>
<option value="0" @if($order->location == '0') selected @endif>In Office </option>
<option value="1" @if($order->location == '1') selected @endif>on Site</option>