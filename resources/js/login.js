// Import the functions you need from the SDKs you need
// import { initializeApp } from "firebase/app";

import firebase from 'firebase/compat/app';
import * as firebaseui from 'firebaseui'
import 'firebaseui/dist/firebaseui.css'
// import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
  authDomain: import.meta.env.VITE_FIREBASE_DOMAIN,
  projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
  storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
  messagingSenderId: import.meta.env.VITE_FIREBASE_SENDER_ID,
  appId: import.meta.env.VITE_FIREBASE_APP_ID,
  measurementId: import.meta.env.VITE_FIREBASE_MEASUREMENT_ID
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// const analytics = getAnalytics(app);
// console.log(firebaseui);
// Initialize the FirebaseUI Widget using Firebase.
var ui = new firebaseui.auth.AuthUI(firebase.auth());
var uiConfig = {
  callbacks: {
    signInSuccessWithAuthResult: function(authResult, redirectUrl) {
      // User successfully signed in.
      // Return type determines whether we continue the redirect automatically
      // or whether we leave that to developer to handle.
      console.log("after sign in");
      console.log(authResult);
      console.log(redirectUrl);
      postUser(authResult.user);
      return false;
    },
    signInFailure: function(error) {
      console.log(error);
      alert(error);
      location.reload();
      // // For merge conflicts, the error.code will be
      // // 'firebaseui/anonymous-upgrade-merge-conflict'.
      // if (error.code != 'firebaseui/anonymous-upgrade-merge-conflict') {
      //   return Promise.resolve();
      // }
      // // The credential the user tried to sign in with.
      // var cred = error.credential;
      // // Copy data from anonymous user to permanent user and delete anonymous
      // // user.
      // // ...
      // // Finish sign-in after data is copied.
      // return firebase.auth().signInWithCredential(cred);
    },
    uiShown: function() {
      // The widget is rendered.
      // Hide the loader.
      // document.getElementById('loader').style.display = 'none';
    }
  },
  // Will use popup for IDP Providers sign-in flow instead of the default, redirect.
  // signInFlow: 'popup',
  // signInSuccessUrl: '/login?signinback=true',
  signInOptions: [
    // Leave the lines as is for the providers you want to offer your users.
    firebase.auth.GoogleAuthProvider.PROVIDER_ID,
    // firebase.auth.FacebookAuthProvider.PROVIDER_ID,
    // firebase.auth.TwitterAuthProvider.PROVIDER_ID,
    // firebase.auth.GithubAuthProvider.PROVIDER_ID,
    // firebase.auth.EmailAuthProvider.PROVIDER_ID,
    // firebase.auth.PhoneAuthProvider.PROVIDER_ID
  ],
  // Terms of service url.
  tosUrl: import.meta.env.VITE_TERM_URL,
  // Privacy policy url.
  privacyPolicyUrl: import.meta.env.VITE_POLICY_URL
};
ui.start('#firebaseui-auth-container', uiConfig);

function postUser(user){
  // Get the user's timezone offset in minutes
  var timezoneOffsetMinutes = new Date().getTimezoneOffset();

  // Convert the offset to hours and minutes
  var hours = Math.abs(Math.floor(timezoneOffsetMinutes / 60));
  var minutes = Math.abs(timezoneOffsetMinutes % 60);

  // Determine if the timezone is ahead or behind UTC
  var sign = (timezoneOffsetMinutes < 0) ? '+' : '-';

  // Display the user's timezone
  var userTimezone =  'UTC' + sign + hours + (minutes ? ':' + minutes : '');

  // console.log('Current user:', user);
  // Create a hidden form element
  var $form = $("<form>", {
      method: "post",
      action: "/login", // Replace with your server endpoint URL
      id: "dynamic-form"
  });

  // Add the CSRF token field for Laravel
  $form.append(
      $("<input>", {
      type: "hidden",
      name: "_token",
      value: $('meta[name="csrf-token"]').attr('content') // Replace with the Laravel CSRF token value
      })
  );

  // Add the 'data' field
  $form.append(
      $("<input>", {
      type: "hidden",
      name: "data",
      value: JSON.stringify(user) // Replace with the value you want to submit
      })
  );
  // Add the 'data' field
  $form.append(
    $("<input>", {
    type: "hidden",
    name: "timeZone",
    value: userTimezone // Replace with the value you want to submit
    })
);

  // Hide the form initially
  $form.hide();

  // Append the form to the container
  $("#dynamic-form-container").append($form);

  // Submit the form in a traditional way without displaying it
  $form.submit();
}
// firebase.auth().onAuthStateChanged(function(user) {
//     if (user) {
//       postUser(user);
//     } else {
//       console.log('No user signed in');
//     }
// });
