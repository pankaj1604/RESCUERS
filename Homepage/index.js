// Hero Sign In Options
let hero_sign_in_btn = document.getElementById('hero-sign-in-btn');
let sign_in_opt = document.getElementById('sign-in-opt');

hero_sign_in_btn.addEventListener('mouseover', ()=>{
    sign_in_opt.style.visibility = "visible";
    sign_in_opt.style.bottom = "-210%"
})

hero_sign_in_btn.addEventListener('mouseout', ()=>{
    sign_in_opt.style.visibility = "hidden";
    sign_in_opt.style.bottom = "-250%"
})

// Hero Sign Up Options
let hero_sign_up_btn = document.getElementById('hero-sign-up-btn');
let sign_up_opt = document.getElementById('sign-up-opt');

hero_sign_up_btn.addEventListener('mouseover', ()=>{
    sign_up_opt.style.visibility = "visible";
    sign_up_opt.style.bottom = "-210%"
})

hero_sign_up_btn.addEventListener('mouseout', ()=>{
    sign_up_opt.style.visibility = "hidden";
    sign_up_opt.style.bottom = "-250%"
})

// Navbar Account
const account = document.querySelector(".account");
const dropdown = document.getElementById("user-icon-opt");

account.addEventListener("click", () => {
    dropdown.style.display =
        dropdown.style.display === "flex" ? "none" : "flex";
});

// Close when clicking outside
document.addEventListener("click", (e) => {
    if (!account.contains(e.target)) {
        dropdown.style.display = "none";
    }
});