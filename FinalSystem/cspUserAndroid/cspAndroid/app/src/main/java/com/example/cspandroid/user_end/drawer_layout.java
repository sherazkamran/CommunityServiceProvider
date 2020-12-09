package com.example.cspandroid.user_end;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.view.View;
import android.os.Bundle;

import com.example.cspandroid.R;
import com.synnapps.carouselview.CarouselView;
import com.synnapps.carouselview.ImageClickListener;
import com.synnapps.carouselview.ImageListener;


import androidx.annotation.Nullable;
import androidx.core.view.GravityCompat;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.widget.ImageView;
import android.widget.Toast;


public class drawer_layout extends AppCompatActivity {

    private int[] c_view_images = new int[]{
            R.drawable.fast_food,R.drawable.vegetables, R.drawable.grocery, R.drawable.garments, R.drawable.meat,  R.drawable.fruits
    };

    private String[] c_view_images_titles = new String[]{
            "fast_food",  "vegetables",  "grocery", "garments",  "meat",
            "fruits"
    };

    private DrawerLayout var_drawer_layout;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.drawer_layout);
        CarouselView c_view = findViewById(R.id.home_carousel);
        c_view.setPageCount(c_view_images.length);
        c_view.setImageListener(new ImageListener() {
            @Override
            public void setImageForPosition(int position, ImageView imageView) {

                imageView.setImageResource(c_view_images[position]);

            }
        });
        c_view.setImageClickListener(new ImageClickListener() {
            @Override
            public void onClick(int position) {
                Toast.makeText(drawer_layout.this, c_view_images_titles[position], Toast.LENGTH_LONG).show();
            }
        });


        var_drawer_layout = (DrawerLayout) findViewById(R.id.drawer_layout);
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
        recreate();
    }

    public void gotoCart(View view) {
        redirectActivity(this, Cart.class);
    }

    public void clickProfile(View view) {
        redirectActivity(this, Profile.class);
    }


    public void clickHistory(View view) {
        redirectActivity(this, History.class);
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
        redirectActivity(this, Shop.class);
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