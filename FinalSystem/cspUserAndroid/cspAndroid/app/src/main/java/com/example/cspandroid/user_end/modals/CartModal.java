package com.example.cspandroid.user_end.modals;

public class CartModal {
    private String cart_item_id;
    private String product_id;
    private String product_quantity;
    private String product_name;
    private String product_price;
    private String sum_price;

    public CartModal() {

    }

    public CartModal(String cart_item_id, String product_id, String product_quantity, String product_name, String product_price, String sum_price) {
        this.cart_item_id = cart_item_id;
        this.product_id = product_id;
        this.product_quantity = product_quantity;
        this.product_name = product_name;
        this.product_price = product_price;
        this.sum_price = sum_price;
    }


    public String getCart_item_id() {
        return cart_item_id;
    }

    public void setCart_item_id(String cart_item_id) {
        this.cart_item_id = cart_item_id;
    }

    public String getProduct_id() {
        return product_id;
    }

    public void setProduct_id(String product_id) {
        this.product_id = product_id;
    }

    public String getProduct_quantity() {
        return product_quantity;
    }

    public void setProduct_quantity(String product_quantity) {
        this.product_quantity = product_quantity;
    }

    public String getProduct_name() {
        return product_name;
    }

    public void setProduct_name(String product_name) {
        this.product_name = product_name;
    }

    public String getProduct_price() {
        return product_price;
    }

    public void setProduct_price(String product_price) {
        this.product_price = product_price;
    }

    public String getSum_price() {
        return sum_price;
    }

    public void setSum_price(String sum_price) {
        this.sum_price = sum_price;
    }

}