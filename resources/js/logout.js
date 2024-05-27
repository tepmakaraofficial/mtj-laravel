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
// Temp variable to hold the anonymous user data if needed.
// var data = null;
// // Hold a reference to the anonymous current user.
// var anonymousUser = firebase.auth().currentUser;
ui.start('#firebaseui-auth-container', {
  // Whether to upgrade anonymous users should be explicitly provided.
  // The user must already be signed in anonymously before FirebaseUI is
  // rendered.
//   autoUpgradeAnonymousUsers: true,
  signInSuccessUrl: '/',
  signInOptions: [
    firebase.auth.GoogleAuthProvider.PROVIDER_ID,
    firebase.auth.FacebookAuthProvider.PROVIDER_ID,
    // firebase.auth.EmailAuthProvider.PROVIDER_ID,
    // firebase.auth.PhoneAuthProvider.PROVIDER_ID
  ],
  callbacks: {
    // signInFailure callback must be provided to handle merge conflicts which
    // occur when an existing credential is linked to an anonymous user.
    signInFailure: function(error) {
      // For merge conflicts, the error.code will be
      // 'firebaseui/anonymous-upgrade-merge-conflict'.
      if (error.code != 'firebaseui/anonymous-upgrade-merge-conflict') {
        return Promise.resolve();
      }
      // The credential the user tried to sign in with.
      var cred = error.credential;
      // Copy data from anonymous user to permanent user and delete anonymous
      // user.
      // ...
      // Finish sign-in after data is copied.
      return firebase.auth().signInWithCredential(cred);
    },
  }
});


firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
      firebase.auth().signOut();
  } else {
    console.log('No user signed in');
  }
  window.location.replace('/');
});
