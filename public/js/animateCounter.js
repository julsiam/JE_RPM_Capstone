// animateCounter.js

// $(document).ready(function() {
//     function animateCounter(target, end, duration) {
//       var numericEnd = parseFloat(end);
  
//       if (!isNaN(numericEnd)) {
//         var options = {
//           startVal: 0,
//           endVal: numericEnd,
//           duration: duration,
//           separator: ',',
//         };
  
//         var counter = new CountUp(target, options);
//         if (!counter.error) {
//           counter.start();
//         } else {
//           console.error(counter.error);
//         }
//       } else {
//         console.error('Invalid numeric value:', end);
//       }
//     }
  
//     // Call the animateCounter function for Total Properties
//     animateCounter('propertyCount', '{{ $totalProperties }}', 2);
//   });
  