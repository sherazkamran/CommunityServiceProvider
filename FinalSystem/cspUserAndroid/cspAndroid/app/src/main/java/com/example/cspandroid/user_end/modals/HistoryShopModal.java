package com.example.cspandroid.user_end.modals;

public class HistoryShopModal {

//    Service	Request Time	Request Date	Location	Description	Status	Service ID

    private String order_item_name;
    private String order_item_price;
    private String order_item_quantity;
    private String order_item_sum_price;
    private String order_total_price;
    private String orderId;
    private String date;
    private String status;

    public String getOrder_total_price() {
        return order_total_price;
    }

    public void setOrder_total_price(String order_total_price) {
        this.order_total_price = order_total_price;
    }

    public String getOrder_item_name() {
        return order_item_name;
    }

    public void setOrder_item_name(String order_item_name) {
        this.order_item_name = order_item_name;
    }

    public String getOrder_item_price() {
        return order_item_price;
    }

    public void setOrder_item_price(String order_item_price) {
        this.order_item_price = order_item_price;
    }

    public String getOrder_item_quantity() {
        return order_item_quantity;
    }

    public void setOrder_item_quantity(String order_item_quantity) {
        this.order_item_quantity = order_item_quantity;
    }

    public String getOrder_item_sum_price() {
        return order_item_sum_price;
    }

    public void setOrder_item_sum_price(String order_item_sum_price) {
        this.order_item_sum_price = order_item_sum_price;
    }

    public String getOrderId() {
        return orderId;
    }

    public void setOrderId(String orderId) {
        this.orderId = orderId;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }


}
