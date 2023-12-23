// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCFSIb9PRVW5qR19bfF1QNRqtHtDv6e5bM",
  authDomain: "binipro-ee596.firebaseapp.com",
  projectId: "binipro-ee596",
  storageBucket: "binipro-ee596.appspot.com",
  messagingSenderId: "20810059485",
  appId: "1:20810059485:web:79c38291ace8ca7aa9d534",
  measurementId: "G-7G901GEDFZ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);