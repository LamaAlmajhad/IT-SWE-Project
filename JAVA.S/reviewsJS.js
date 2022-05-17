
const reviews = [
  {
    id: 1,
    name: "Ram",
    email: "ram@gmail.com",
    img:
      "https://cdn.pixabay.com/photo/2018/11/13/21/43/instagram-3814049__340.png",
    text:
"The care and the level of service was awesome. The amazing attention to the level of details paid by the crew to each passenger was noteworthy. It felt like if you're flying a private jet. Having a Flight Chef on board makes a great deal of difference in the level of service."  },
  {
    id: 2,
    name: "Anonymous",
    email: "anees@gamil.com",
    img:
      "https://cdn.pixabay.com/photo/2018/11/13/21/43/instagram-3814049__340.png",
    text:
    "I booked my flight with booking.com, but Saudia cancelled my flight 1 day before boarding. I contacted booking for refund but they sent to me e-mail explaining that the company is not answering.I don't advise any person to try flying with Saudia."  },
  {
    id: 3,
    name: "james",
    email: "james@gamil.com",
    img:
      "https://cdn.pixabay.com/photo/2018/11/13/21/43/instagram-3814049__340.png",
    text:
"I absolutely loved it, seats were very comfortable, food is exquisite, and I absolutely loved the napkins to clean the teeth. The flight entertainment can be a bit more diversified and recent. At the check in counter the lady was very sweet and helpful. Keep up the good work, and looking forward for my next trip."  },
  {
    id: 4,
    name: "Anonymous",
    email: "",
    img:
      "https://cdn.pixabay.com/photo/2018/11/13/21/43/instagram-3814049__340.png",
    text:
"I used to travel on Saudia then I switched to Emirates due to incline in the service level, but my two recent trips have changed my mind completely. From check in counter to Aircraft condition, food and beverages to the arrival and collecting the luggage is all smooth."  }
];

const img = document.getElementById("person-img");
const author = document.getElementById("author");
const email = document.getElementById("email");
const info = document.getElementById("info");

const prevBtn = document.querySelector(".prev-btn");
const nextBtn = document.querySelector(".next-btn");

let currentItem = 0;

// load initial item
window.addEventListener("DOMContentLoaded", () => {
  const item = reviews[currentItem];
  img.src = item.img;
  author.textContent = item.name;
  email.textContent = item.email;
  info.textContent = item.text;
});

// show person based on item
function showPerson(person) {
  const item = reviews[person];
  img.src = item.img;
  author.textContent = item.name;
  email.textContent = item.email;
  info.textContent = item.text;
}

// show next person
nextBtn.addEventListener("click", () => {
  currentItem++;
  if (currentItem > reviews.length - 1) {
    currentItem = 0;
  }
  showPerson(currentItem);
});

// show prev person
prevBtn.addEventListener("click", () => {
  currentItem--;
  if (currentItem < 0) {
    currentItem = reviews.length - 1;
  }
  showPerson(currentItem);
});

var lClicks = 0;
var dClicks = 0;

$(".likes").on("click", function(){
   if( document.getElementById("dislikes").style.pointerEvents != "none"){
	lClicks += 1;
    document.getElementById("l-counter").innerHTML = lClicks;
   document.getElementById("likes").style.backgroundColor= "#4475c0";
   document.getElementById("dislikes").style.backgroundColor= "gray";
   document.getElementById("dislikes").style.pointerEvents= "none";
  }
       else if( document.getElementById("dislikes").style.pointerEvents == "none"){  
        
     lClicks -= 1;
       document.getElementById("l-counter").innerHTML = lClicks;
       document.getElementById("dislikes").style.backgroundColor= "#7209b7";
        document.getElementById("likes").style.backgroundColor= "#7209b7";
        document.getElementById("likes").style.pointerEvents= "auto";
         document.getElementById("dislikes").style.pointerEvents= "auto";
     }
     
})

$(".dislikes").on("click", function(){ 
   if( document.getElementById("likes").style.pointerEvents != "none"){
	dClicks += 1;
    document.getElementById("d-counter").innerHTML = dClicks;
    document.getElementById("dislikes").style.backgroundColor= "#4475c0";
 
     document.getElementById("likes").style.backgroundColor= "gray";
        document.getElementById("likes").style.pointerEvents= "none";
    
     }
     else if( document.getElementById("likes").style.pointerEvents == "none"){  
        
     dClicks -= 1;
      document.getElementById("d-counter").innerHTML = dClicks;
       document.getElementById("dislikes").style.backgroundColor= "#7209b7";
        document.getElementById("likes").style.backgroundColor= "#7209b7";
        document.getElementById("likes").style.pointerEvents= "auto";
         document.getElementById("dislikes").style.pointerEvents= "auto";
     }
})
