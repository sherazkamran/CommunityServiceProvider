package com.example.cspandroid.user_end;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.view.View;
import android.os.Bundle;

import com.example.cspandroid.R;


import androidx.annotation.Nullable;
import androidx.core.view.GravityCompat;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.TextView;


public class History extends AppCompatActivity {


    private DrawerLayout var_drawer_layout;
    private TextView txtvw_info_history;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_history);


        var_drawer_layout = (DrawerLayout) findViewById(R.id.activity_history);
    }

    public void changeVisibilityInfoTextHistory(View view) {
        txtvw_info_history = (TextView) findViewById(R.id.txtvw_info_history);

        if (txtvw_info_history.getVisibility() == View.INVISIBLE || txtvw_info_history.getVisibility() == View.GONE) {
            txtvw_info_history.setVisibility(View.VISIBLE);

        } else if (txtvw_info_history.getVisibility() == View.VISIBLE) {
            txtvw_info_history.setVisibility(View.INVISIBLE);
        }
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
        recreate();
    }

    public void toShoppingHistory(View view) {
        redirectActivity(this, ShoppingHistory.class);
    }

    public void toComplaintsHistory(View view) {
        redirectActivity(this, ComplaintsHistory.class);
    }

    public void toReservationsHistory(View view) {
        redirectActivity(this, ReservationsHistory.class);
    }

    public void toServicesHistory(View view) {
        redirectActivity(this, ServicesHistory.class);
    }


    public void gotoCart(View view) {

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
        recreate();
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