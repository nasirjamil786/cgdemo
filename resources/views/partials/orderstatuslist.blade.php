<option value="Booked" @if($order->order_status == 'Booked') selected @endif>Booked</option>
<option value="Device Received" @if($order->order_status == 'Device Received') selected @endif>Device Received</option>
<option value="Work in Progress" @if($order->order_status == 'Work in Progress') selected @endif>Work in Progress</option>
<option value="Parts Required" @if($order->order_status == 'Parts Required') selected @endif>Parts Required</option>
<option value="Waiting for Parts" @if($order->order_status == 'Waiting for Parts') selected @endif>Waiting for Parts</option>
<option value="Work Complete" @if($order->order_status == 'Work Complete') selected @endif>Work Completed</option>
<option value="Call To Arrange Collection" @if($order->order_status == 'Call To Arrange Collection') selected @endif>Call To Arrange Collection</option>
<option value="Collection Scheduled" @if($order->order_status == 'Collection Scheduled') selected @endif>Collection Scheduled</option>
<option value="Visit Scheduled" @if($order->order_status == 'Visit Scheduled') selected @endif>Visit Scheduled</option>
<option value="Collected Unpaid" @if($order->order_status == 'Collected Unpaid') selected @endif>Collected Unpaid</option>
<option value="Invoiced" @if($order->order_status == 'Invoiced') selected @endif>Invoiced</option>
<option value="Paid" @if($order->order_status == 'Paid') selected @endif>Paid</option>
<option value="Payment Receipt Sent" @if($order->order_status == 'Payment Receipt Sent') selected @endif>Payment Receipt Sent</option>
<option value="Courtsey Call Required" @if($order->order_status == 'Courtsey Call Required') selected @endif>Courtsey Call Required</option>
<option value="Closed" @if($order->order_status == 'Closed') selected @endif>Closed</option>
<option value="Cancelled" @if($order->order_status == 'Cancelled') selected @endif>Cancelled</option>