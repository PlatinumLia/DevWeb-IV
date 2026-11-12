// firebase.js
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getDatabase, ref, push, onValue, remove, update, get } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

const firebaseConfig = {
  apiKey: "AIzaSyB7S_Im53NnolsY1aTzLNHxBhEPxnxjQhE",
  authDomain: "aquario-7d5f2.firebaseapp.com",
  databaseURL: "https://aquario-7d5f2-default-rtdb.firebaseio.com",
  projectId: "aquario-7d5f2",
  storageBucket: "aquario-7d5f2.firebasestorage.app",
  messagingSenderId: "777129398312",
  appId: "1:777129398312:web:ce2757a225860959a3a51d"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

export const db = getDatabase(app);
export { ref, push, onValue, remove, update, get };