const logTagValue = document.querySelector("#log-a-tag").text; //get a tag php echo value
const logTag = document.querySelector("#log-a-tag"); //get the actual a tag
const slideTag = document.querySelector("#sliding-nav-icon"); //get the a tag of slding nav
const closeSlideTag = document.querySelector("#close-sliding-nav");
//get show replies links
const showReplies= document.querySelector("#show_replies");
const showRepliesDiv= document.getElementById("comment_replies_div");
if(logTagValue === "Sign In"){
  document.querySelector("#log-out-tag").text = ""; //set logout link invisible
  // startTopicHref.setAttribute('name','login-first');
}else{
  // change link to myprofile.php if user is already logged in
    logTag.setAttribute('href','myProfile.php');
}
function slide(){
  document.querySelector('#sliding-nav').style.left = "0";
}
function close(){
  document.querySelector('#sliding-nav').style.left = "-200px";
}
function showMyReplies(){
  // set a if condition to make the div show and hide according to condition
  if(showReplies.innerHTML==="Hide Replies"){
    showRepliesDiv.style.display = "none";
    showRepliesDiv.style.opacity = "0";
    showReplies.innerHTML="Show Replies";
    showReplies.addEventListener('click',hideMyReplies);
  }if(showReplies.innerHTML==="Show Replies"){
    showRepliesDiv.style.display = "block";
    showRepliesDiv.style.opacity = "1";
    showReplies.innerHTML="Hide Replies";
  }
}

function eventListeners(){
  slideTag.addEventListener('click',slide);
  closeSlideTag.addEventListener('click',close);
  showReplies.addEventListener('click',showMyReplies);

}
eventListeners();
