package com.example.cspandroid.user_end;


import android.content.SharedPreferences;

import com.example.cspandroid.user_end.modals.CartModal;

import java.util.ArrayList;
import java.util.List;

public class Constants {

    public static String URL = "http://192.168.43.198/cspUserAndroid/cspUserAndroidMain.php";
    public static SharedPreferences sharedPreferences;
    public static String VENDOR = "any";


    public static String logged_in_user_id;
    public static String outer_path_to_images = "http://192.168.43.198/cspManager/";
    public static List<CartModal> CART_ITEMS = new ArrayList<>();
}
