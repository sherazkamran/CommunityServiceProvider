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


public class Reserve extends AppCompatActivity implements AdapterView.OnItemSelectedListener {


    private DrawerLayout var_drawer_layout;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reserve);


        Spinner spinner_available_vehicles = (Spinner) findViewById(R.id.spinner_available_vehicles);
        ArrayAdapter<CharSequence> spin_adapter = ArrayAdapter.createFromResource(this, R.array.vehicles_to_reserve, android.R.layout.simple_spinner_item);
        spin_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner_available_vehicles.setAdapter(spin_adapter);
        spinner_available_vehicles.setOnItemSelectedListener(this);

        var_drawer_layout = (DrawerLayout) findViewById(R.id.activity_reserve);
    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }

    public void changeVisibilityReserveInfo(View view) {

        TextView tv_reserve_info = (TextView) findViewById(R.id.tv_reserve_info);

        if (tv_reserve_info.getVisibility() == View.INVISIBLE || tv_reserve_info.getVisibility() == View.GONE) {
            tv_reserve_info.setVisibility(View.VISIBLE);

        } else if (tv_reserve_info.getVisibility() == View.VISIBLE) {
            tv_reserve_info.setVisibility(View.INVISIBLE);
        }
    }


    public void clickMenu(View view) {
        openDrawer(var_drawer_layout);
    }

    public static void openDrawer(DrawerLayout vawer_layout) {
        vawer_layout.openDrawer(GravityCompat.START);
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