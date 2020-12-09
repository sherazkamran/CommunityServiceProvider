package com.example.cspandroid.user_end.modals;

public class ShopModal {

    private int product_id;
    private String image;
    private String description;
    private int prodcat_id;
    private String name;
    private int price;

    public int getProduct_id() {
        return product_id;
    }

    public void setProduct_id(int product_id) {
        this.product_id = product_id;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getProdcat_id() {
        return prodcat_id;
    }

    public void setProdcat_id(int prodcat_id) {
        this.prodcat_id = prodcat_id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getPrice() {
        return price;
    }

    public void setPrice(int price) {
        this.price = price;
    }

    public ShopModal(int product_id, String image, String description, int prodcat_id, String name, int price) {
        this.product_id = product_id;
        this.image = image;
        this.description = description;
        this.prodcat_id = prodcat_id;
        this.name = name;
        this.price = price;
    }


    public ShopModal() {
    }


}
