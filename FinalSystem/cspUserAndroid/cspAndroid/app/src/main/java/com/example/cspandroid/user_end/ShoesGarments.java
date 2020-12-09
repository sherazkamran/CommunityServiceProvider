//package com.example.cspandroid.user_end;
//
//import androidx.appcompat.app.AppCompatActivity;
//
//import android.os.Bundle;
//
//import com.example.cspandroid.R;
//
//public class ShoesGarments extends AppCompatActivity {
//
//    @Override
//    protected void onCreate(Bundle savedInstanceState) {
//        super.onCreate(savedInstanceState);
//        setContentView(R.layout.activity_shoes_garments);
//    }
//}

package com.example.cspandroid.user_end;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.net.Uri;
import android.util.Log;
import android.view.View;
import android.os.Bundle;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.cspandroid.R;
import com.example.cspandroid.user_end.adapters.ShopMainAdapter;
import com.example.cspandroid.user_end.modals.ShopModal;
import com.google.android.material.floatingactionbutton.FloatingActionButton;


import androidx.annotation.Nullable;
import androidx.core.view.GravityCompat;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import static com.example.cspandroid.user_end.Constants.URL;


public class ShoesGarments extends AppCompatActivity {


    private DrawerLayout var_drawer_layout;
    private FloatingActionButton fab_ic_more;
    private ImageView ic_cart_shop;
    private LinearLayout all_shop_cat;
    private LinearLayout layout_cat_name;
    private Button btn_shop_cat_g;


    private ShopMainAdapter shop_main_adapter;
    private List<ShopModal> shopModalList;
    private GridView gridView;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_shoes_garments);
        var_drawer_layout = (DrawerLayout) findViewById(R.id.activity_shoes_garments);
        fab_ic_more = (FloatingActionButton) findViewById(R.id.fab_ic_more);
        ic_cart_shop = (ImageView) findViewById(R.id.ic_cart_shop);

        gridView = findViewById(R.id.grid_view_sg);


//      check-1 START //////////////////////////////////////////////////////////////////////////////
        shopModalList = new ArrayList<>();
        shop_main_adapter = new ShopMainAdapter(ShoesGarments.this, shopModalList);
        gridView.setAdapter(shop_main_adapter);
        getData();

//      check-1 END //////////////////////////////////////////////////////////////////////////////
        gridView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                Intent i = new Intent(getApplicationContext(), SingleProduct.class);


                ShopModal modal = shopModalList.get(position);
                String outerPath = "http://192.168.43.198/cspManager/" + modal.getImage();
                Uri actualPath = Uri.parse(outerPath);
                int idid = modal.getProduct_id();
                String prod_id = Integer.toString(idid);
                String itemName = modal.getName();
                String itemDescription = modal.getDescription();
                int i_Price = modal.getPrice();
                String itemPrice = Integer.toString(i_Price);


                i.putExtra("idOfProduct", prod_id);
                i.putExtra("nameOfItem", itemName);
                i.putExtra("descOfItem", itemDescription);
                i.putExtra("priceOfItem", itemPrice);
                i.putExtra("uriOfItemImage", actualPath.toString());

                startActivity(i);
            }
        });
    }


    public void getData() {
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if (!response.equals("fail")) {
                    try {
                        JSONArray array = new JSONArray(response);
                        JSONObject object;
                        for (int i = 0; i < array.length(); i++) {
                            object = array.getJSONObject(i);
                            ShopModal modal = new ShopModal();
                            modal.setProduct_id(object.getInt("product_id"));
                            modal.setImage(object.getString("image"));
                            modal.setDescription(object.getString("description"));
                            modal.setProdcat_id(object.getInt("prodcat_id"));
                            modal.setName(object.getString("name"));
                            modal.setPrice(object.getInt("price"));
                            shopModalList.add(modal);
                            shop_main_adapter.notifyDataSetChanged();
                        }
                    } catch (JSONException e) {
                        Log.e("data exception", e.toString());
                    }
                } else {
                    Toast.makeText(getApplicationContext(), "Failed to get. Try again later", Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Internet connection error", Toast.LENGTH_SHORT).show();
            }
        }) {
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<String, String>();
                params.put("function", "getSGProducts");
                return params;
            }
        };
        queue.add(request);
    }

    public void openCatView(View view) {
        fab_ic_more.setVisibility(View.INVISIBLE);
        ic_cart_shop.setVisibility(View.INVISIBLE);
        all_shop_cat = findViewById(R.id.all_shop_cat);
        all_shop_cat.setVisibility(View.VISIBLE);
        layout_cat_name = findViewById(R.id.layout_cat_name);
        layout_cat_name.setVisibility(View.INVISIBLE);
        Toast.makeText(ShoesGarments.this, "IC_more Clicked!!", Toast.LENGTH_SHORT).show();
    }

    public void openShop(View view) {
        redirectActivity(this, Shop.class);
    }

    public void openFastFood(View view) {

        redirectActivity(this, FastFood.class);
    }

    public void openfruits(View view) {
        redirectActivity(this, FruitsVegetables.class);
    }

    public void openShoes(View view) {
        recreate();
    }

    public void openHomeAppliances(View view) {
        redirectActivity(this, HomeAppliances.class);
    }


    public void clickMenu(View view) {
        openDrawer(var_drawer_layout);
    }

    public static void openDrawer(DrawerLayout var_drawer_layout) {
        var_drawer_layout.openDrawer(GravityCompat.START);
    }

    public void clickLogo(View view) {
        closeDrawer(var_drawer_layout);
    }

    public static void closeDrawer(DrawerLayout var_drawer_layout) {
        if (var_drawer_layout.isDrawerOpen(GravityCompat.START)) {
            var_drawer_layout.closeDrawer(GravityCompat.START);
        }
    }

    public void clickHome(View view) {

        redirectActivity(this, drawer_layout.class);
    }

    public void clickHistory(View view) {
        redirectActivity(this, History.class);
    }



    public void gotoCart(View view) {
        redirectActivity(this, Cart.class);
    }

    public void clickProfile(View view) {
        redirectActivity(this, Profile.class);
    }


    public void clickComplaints(View view) {
        redirectActivity(this, Complaints.class);
    }

    public void clickHireServices(View view) {
        redirectActivity(this, HireServices.class);
    }

    public void clickPayBills(View view) {
        redirectActivity(this, PayBills.class);
    }

    public void clickReserve(View view) {
        redirectActivity(this, Reserve.class);
    }

    public void clickShop(View view) {
        recreate();
    }


    public void clickLogout(View view) {
        logout(this);
    }

    public static void logout(final Activity activity) {
        AlertDialog.Builder builder = new AlertDialog.Builder(activity);
        builder.setTitle("LOGOUT");
        builder.setMessage("Yes to logout...No to stay in...");
        builder.setPositiveButton("YES", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                activity.finishAffinity();
                System.exit(0);
            }
        });
        builder.setNegativeButton("NO", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        });
        builder.show();

    }


    public static void redirectActivity(Activity activity, Class aClass) {
        Intent intent = new Intent(activity, aClass);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        activity.startActivity(intent);

    }

    @Override
    protected void onPause() {
        super.onPause();
        closeDrawer(var_drawer_layout);
    }
}