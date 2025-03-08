<option value="Booked" @if($order->order_status == 'Booked') selected @endif>Booked</option>
<option value="Device Received" @if($order->order_status == 'Device Received') selected @endif>Device Received</option>
<option value="Work in Progress" @if($order->order_status == 'Work in Progress') selected @endif>Work in Progress</option>
<option value="Parts Required" @if($order->order_status == 'Parts Required') selected @endif>Parts Required</option>
<option value="Waiting for Parts" @if($order->order_status == 'Waiting for Parts') selected @endif>Waiting for Parts</option>
<option value="Waiting for Customer Response" @if($order->order_status == 'Waiting for Customer Response') selected @endif>Waiting for Customer Response</option>
<option value="Work Complete" @if($order->order_status == 'Work Complete') selected @endif>Work Completed</option>
<option value="Call To Arrange Collection" @if($order->order_status == 'Call To Arrange Collection') selected @endif>Call To Arrange Collection</option>
<option value="Collection Scheduled" @if($order->order_status == 'Collection Scheduled') selected @endif>Collection Scheduled</option>
<option value="Visit Scheduled" @if($order->order_status == 'Visit Scheduled') selected @endif>Visit Scheduled</option>
<option value="Collected Unpaid" @if($order->order_status == 'Collected Unpaid') selected @endif>Collected Unpaid</option>
<option value="Payment Receipt Sent" @if($order->order_status == 'Payment Receipt Sent') selected @endif>Payment Receipt Sent</option>
<option value="Courtsey Call Required" @if($order->order_status == 'Courtsey Call Required') selected @endif>Courtsey Call Required</option>
<option value="With Phone4Less" @if($order->order_status == 'With Phone4Less') selected @endif>With Phone4Less</option>
<option value="With Brandlab" @if($order->order_status == 'With Brandlab') selected @endif>With Brandlab</option>
<option value="With PhoneBooth" @if($order->order_status == 'With PhoneBooth') selected @endif>With PhoneBooth</option>
<option value="With Nyasha" @if($order->order_status == 'With Nyasha') selected @endif>With Nyasha</option>
<option value="Invoiced" @if($order->order_status == 'Invoiced') selected @endif>Invoiced</option>

@if(Auth::user()->can_closeOrder == 1)
  <option value="Closed" @if($order->order_status == 'Closed') selected @endif>Closed</option>
@endif

@can('admin-only')
<option value="Paid" @if($order->order_status == 'Paid') selected @endif>Paid</option>
<option value="Cancelled" @if($order->order_status == 'Cancelled') selected @endif>Cancelled</option>
@endcan