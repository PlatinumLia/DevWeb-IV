
// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDZZo_wH8dj5rKAlGhroXM_l0Wi8rHpbkQ",
  authDomain: "arduino-firebase-69472.firebaseapp.com",
  databaseURL: "https://arduino-firebase-69472-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "arduino-firebase-69472",
  storageBucket: "arduino-firebase-69472.firebasestorage.app",
  messagingSenderId: "941335354599",
  appId: "1:941335354599:web:a0eb30d3c375dac6699642"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

const db = getDatabase(app);
const Ref=ref(db, "dados");

const params = new URLSearchParams(window.location.search);
const temp = params.get("temp");
const umid = params.get("umid");

if(temp && umid){
    set(Ref), {
        temperatura: Number(temp),
        umidade: Number(umid),
    }
}