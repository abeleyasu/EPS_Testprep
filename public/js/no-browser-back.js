history.pushState(null, null, document.URL);
window.addEventListener('popstate', function(event) {
    history.pushState(null, null, document.URL);
    alert("Please do not use the browser's back button - instead, please use the \"Previous Step\" button or click the Step Number above.");
});

// window.addEventListener('unload', function(event) {
//     if (event.currentTarget.performance && event.currentTarget.performance.navigation) {
//         if (event.currentTarget.performance.navigation.type === PerformanceNavigation.TYPE_BACK_FORWARD) {
//             // The user clicked the browser's back button
//             alert("Browser back button is clicked.");
//         }
//     } else {
//         if (event.clientX < 40 && event.clientY < 0) {
//             // The user clicked the browser's back button
//             alert("Browser back button is clicked.");
//         }
//     }
// });

// window.onbeforeunload = function () {
//     return "Please do not use the browser's back button - instead, please use the \"Previous\" button or click the Step Number above.";
//     return true;
// };

// window.addEventListener('popstate', function(event) {
//     event.preventDefault(); // Prevents the default back navigation
//     // Show a custom alert or perform any desired action
//     alert("Please do not use the browser's back button - instead, please use the \"Previous Step\" button or click the Step Number above.");
// });