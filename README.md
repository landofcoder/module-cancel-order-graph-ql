# module-cancel-order-graph-ql
Magento 2 cancel order graph ql - allow customer send cancel order request to admin.

The module require setup module: https://landofcoder.com/magento-2-cancel-order.html

## Overview
 Extension makes the order cancellation easier for both customers and store owners

How module work?

 Cancel orders right from the frontend
 Customers can add comments for each product they cancelled
 Admins are able to customize the settings
 Using emails for notification
 Customers can delete orders right from their front-end.

 On the Account Dashboard display, customers can see all the recent orders that they have purchased with accompanied ‘cancel order’ link
 Customers can also cancel orders in My Order tab.
 The reasons of canceled orders are addressed by reading the customers’ comments

 When customers click on ‘Cancel Order’ link, a popup will appear, from which they can insert their comments and reasons for canceling the orders.
 This helps vendors to know the exact reasons of order cancellation; thereby, they know how to improve their lacking aspects.
 Store owners are allowed to configure the settings

 They can change the ‘Cancel order’ link or button text
 They can change the ‘Cancel order’ form header text
 They can change the ‘Cancel order’ note text
 They can set up a custom mail template for order cancellation, and custom display messages.
 They can enable and disable functionality from backend.
 Admins are more organized with notification system

Whenever a product is cancelled, an email will be automatically sent to the admin.
It saves a lot of time and effort for store owners to manage their product quality better.
    
## Main Features:
   - Allow customers to cancel Pending orders from the frontend
   -  Allow customers to enter comments in a confirmation popup
   - Send Notification Emails to admins automatically after customers canceled orders
   -  Change order status from Pending to Canceled and auto restock products
   -  Manage all comments of customer
   -  Enable to set email sender, email receiver and email template in the backend
   - Enable to configure Cancel Order button and Notice notes of the confirm popup
```
{
  lofCancelOrder(
    order_id: "000000016",
    customer_comment: "tets"
  ){
    message
  }
}
```
