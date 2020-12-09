package com.example.cspandroid.user_end;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.constraintlayout.widget.ConstraintLayout;

import com.example.cspandroid.R;

import java.util.HashMap;
import java.util.Map;

import static com.example.cspandroid.user_end.Constants.URL;

import static com.example.cspandroid.user_end.Constants.logged_in_user_id;
import static com.example.cspandroid.user_end.Constants.sharedPreferences;


import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;


public class Login extends AppCompatActivity {
    private Button btn_signup_login, btn_login_login;
    private ConstraintLayout con_layout_login;
    private EditText edtTxt_password_login, edtTxt_email_login, eml, pwd;
    private String temp_edtTxt_password_login, temp_edtTxt_email_login, lgn;


    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);


        edtTxt_password_login = (EditText) findViewById(R.id.edtTxt_password_login);
        edtTxt_email_login = (EditText) findViewById(R.id.edtTxt_email_login);

        sharedPreferences = getSharedPreferences("app", MODE_PRIVATE);
        btn_signup_login = (Button) findViewById(R.id.btn_signup_login);
        con_layout_login = (ConstraintLayout) findViewById(R.id.con_layout_login);
        btn_login_login = (Button) findViewById(R.id.btn_login_login);


        eml = findViewById(R.id.edtTxt_email_login);
        pwd = findViewById(R.id.edtTxt_password_login);
        con_layout_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                close_keyboard();
            }
        });

        btn_signup_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                open_signup();
            }
        });

    }


    public void loginUser(View view) {
        final String eml2 = edtTxt_email_login.getText().toString();
        final String pwd2 = edtTxt_password_login.getText().toString();
        if (eml2.isEmpty() || pwd2.isEmpty()) {
            Toast.makeText(this, "All Fields are required", Toast.LENGTH_LONG).show();
            return;
        } else {
            RequestQueue queue = Volley.newRequestQueue(this);
            StringRequest request = new StringRequest(Request.Method.POST, Constants.URL,
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            if (!response.equals("failed")) {
                                Toast.makeText(Login.this, "Login Successful", Toast.LENGTH_LONG).show();

                                String receivedUserID = response;
                                logged_in_user_id = receivedUserID;
                                sharedPreferences.edit().putString("login", response).apply();
                                open_drawer_layout();

                            } else {
                                Toast.makeText(Login.this, "Failed! Try again later", Toast.LENGTH_LONG).show();
                            }
                        }
                    }
                    , new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(Login.this, "" + error, Toast.LENGTH_LONG).show();
                }
            }) {
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<String, String>();
                    params.put("function", "login");
                    params.put("email", eml2);
                    params.put("password", pwd2);
                    return params;
                }
            };
            queue.add(request);
        }
    }


    private void open_drawer_layout() {
        Intent intent = new Intent(this, drawer_layout.class);
        startActivity(intent);
    }


    private void open_signup() {
        Intent intent = new Intent(this, Signup.class);
        startActivity(intent);
    }

    private void close_keyboard() {
        View view = this.getCurrentFocus();
        if (view != null) {
            InputMethodManager imm = (InputMethodManager) getSystemService(getApplicationContext().INPUT_METHOD_SERVICE);
            imm.hideSoftInputFromWindow(view.getWindowToken(), 0);
        }
    }


}
