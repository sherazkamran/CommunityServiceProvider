package com.example.cspandroid.user_end;


import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

import android.content.Intent;
import android.view.inputmethod.InputMethodManager;
import android.widget.Button;
import android.widget.ImageView;

import androidx.annotation.Nullable;
import androidx.constraintlayout.widget.ConstraintLayout;

import com.example.cspandroid.R;

import static com.example.cspandroid.user_end.Constants.URL;

import static com.example.cspandroid.user_end.Constants.sharedPreferences;

public class Signup extends AppCompatActivity {

    private Button btn_login_signup;
    private ImageView arrow_back;
    private ConstraintLayout con_layout_signup;

    private Button btn_signup_signup;
    private EditText edtTxt_name_signup, edtTxt_email_signup, edtTxt_cnic_signup, edtTxt_phase_signup, edtTxt_street_signup, edtTxt_house_signup, edtTxt_contact_signup, edtTxt_password_signup, edtTxt_re_password_signup;

    private String temp_edtTxt_name_signup, temp_edtTxt_email_signup, temp_edtTxt_cnic_signup, temp_edtTxt_phase_signup, temp_edtTxt_street_signup, temp_edtTxt_house_signup, temp_edtTxt_contact_signup, temp_edtTxt_re_password_signup, temp_edtTxt_password_signup;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);


        setContentView(R.layout.activity_signup);

        btn_login_signup = (Button) findViewById(R.id.btn_login_signup);
        arrow_back = (ImageView) findViewById(R.id.arrow_back);
        con_layout_signup = (ConstraintLayout) findViewById(R.id.con_layout_signup);

        edtTxt_name_signup = (EditText) findViewById(R.id.edtTxt_name_signup);
        edtTxt_email_signup = (EditText) findViewById(R.id.edtTxt_email_signup);
        edtTxt_cnic_signup = (EditText) findViewById(R.id.edtTxt_cnic_signup);
        edtTxt_phase_signup = (EditText) findViewById(R.id.edtTxt_phase_signup);
        edtTxt_street_signup = (EditText) findViewById(R.id.edtTxt_street_signup);
        edtTxt_house_signup = (EditText) findViewById(R.id.edtTxt_house_signup);
        edtTxt_contact_signup = (EditText) findViewById(R.id.edtTxt_contact_signup);
        edtTxt_password_signup = (EditText) findViewById(R.id.edtTxt_password_signup);
        edtTxt_re_password_signup = (EditText) findViewById(R.id.edtTxt_re_password_signup);
        btn_signup_signup = (Button) findViewById(R.id.btn_signup_signup);


        con_layout_signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                close_keyboard();
            }
        });

        arrow_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                open_login();
            }
        });

        btn_login_signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                open_login();
                close_keyboard();
            }

        });
    }


    public void signUpUser(View view) {
        close_keyboard();
        temp_edtTxt_name_signup = edtTxt_name_signup.getText().toString();
        temp_edtTxt_email_signup = edtTxt_email_signup.getText().toString();
        temp_edtTxt_cnic_signup = edtTxt_cnic_signup.getText().toString();
        temp_edtTxt_phase_signup = edtTxt_phase_signup.getText().toString();
        temp_edtTxt_street_signup = edtTxt_street_signup.getText().toString();
        temp_edtTxt_house_signup = edtTxt_house_signup.getText().toString();
        temp_edtTxt_contact_signup = edtTxt_contact_signup.getText().toString();
        temp_edtTxt_password_signup = edtTxt_password_signup.getText().toString();
        temp_edtTxt_re_password_signup = edtTxt_re_password_signup.getText().toString();

        if (!(temp_edtTxt_name_signup.isEmpty() || temp_edtTxt_email_signup.isEmpty() || temp_edtTxt_cnic_signup.isEmpty() || temp_edtTxt_phase_signup.isEmpty() || temp_edtTxt_street_signup.isEmpty() || temp_edtTxt_house_signup.isEmpty() || temp_edtTxt_contact_signup.isEmpty() || temp_edtTxt_re_password_signup.isEmpty() || temp_edtTxt_password_signup.isEmpty())) {
            if (temp_edtTxt_password_signup.equals(temp_edtTxt_re_password_signup)) {
                if (!Patterns.EMAIL_ADDRESS.matcher(temp_edtTxt_email_signup).matches()) {
                    edtTxt_email_signup.setError("invalid email");
                    return;
                } else if (temp_edtTxt_password_signup.length() < 6 || temp_edtTxt_re_password_signup.length() < 6) {
                    edtTxt_password_signup.setError("Password too short");
                    return;
                } else {
                    RequestQueue queue = Volley.newRequestQueue(this);
                    StringRequest request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            if (response.equals("added")) {
                                Toast.makeText(getApplicationContext(), "SignUp Successful!", Toast.LENGTH_LONG).show();
                                open_login();
                            } else {
                                Toast.makeText(getApplicationContext(), "Failed to add. Try again later", Toast.LENGTH_LONG).show();
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
                            params.put("function", "newUser");
                            params.put("name", temp_edtTxt_name_signup);
                            params.put("email", temp_edtTxt_email_signup);
                            params.put("password", temp_edtTxt_password_signup);
                            params.put("cnic", temp_edtTxt_cnic_signup);
                            params.put("phase", temp_edtTxt_phase_signup);
                            params.put("streetNo", temp_edtTxt_street_signup);
                            params.put("houseNo", temp_edtTxt_house_signup);
                            params.put("contactNo", temp_edtTxt_contact_signup);
                            params.put("status", "pending");
                            return params;
                        }
                    };
                    queue.add(request);
                }
            } else {
                Toast.makeText(getApplicationContext(), "Passwords Miss-Match. Enter correctly!", Toast.LENGTH_LONG).show();
            }
        } else {
            Toast.makeText(getApplicationContext(), "Provide all Information!", Toast.LENGTH_LONG).show();
        }


    }

    private void open_login() {
        Intent intent = new Intent(this, Login.class);
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


