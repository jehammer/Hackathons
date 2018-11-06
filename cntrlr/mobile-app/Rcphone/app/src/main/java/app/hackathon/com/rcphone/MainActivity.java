package app.hackathon.com.rcphone;

import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;

import com.github.nkzawa.emitter.Emitter;
import com.github.nkzawa.socketio.client.IO;
import com.github.nkzawa.socketio.client.Socket;
import android.content.Intent;

import android.telephony.SmsManager;

import org.json.*;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_main);

        try {
            Log.i("fff","ff");
            Socket mSocket = IO.socket("http://10.1.107.44:8090");

            //mSocket.emit("test", "woa");

            mSocket.on(Socket.EVENT_CONNECT, new Emitter.Listener() {

                @Override
                public void call(Object... args) {
                    Log.d("ActivityName: ", "socket connected");

                    // emit anything you want here to the server
                    //socket.emit("login", some);
                    //socket.disconnect();
                }

                // this is the emit from the server
            }).on("message", new Emitter.Listener() {

                @Override
                public void call(Object... args) {
                   //Log.i("TEST",(String)args[0]);

                    try {
                        JSONObject obj = (JSONObject) args[0];
                        //String message = obj.toString();
                        //Log.i("TEST", obj.getString("number"));
                        //Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse("sms:" + obj.getString("number")));
                        //intent.putExtra("sms_body", obj.getString("content"));
                        //startActivity(intent);
                        sendSMS(obj.getString("number"),obj.getString("content"));
                    }catch(Exception e){
                        e.printStackTrace();
                    }

                }
            });

            mSocket.connect();

        }catch(Exception e){
            e.printStackTrace();
        }


    }

    private void sendSMS(String phoneNumber, String message) {
        SmsManager sms = SmsManager.getDefault();
        sms.sendTextMessage(phoneNumber, null, message, null, null);
    }


}
