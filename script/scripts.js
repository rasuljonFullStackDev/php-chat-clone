const serach_item = document.querySelector(".serach_item"),
chat_search_btn = document.querySelector(".chat_search_btn");
let search_bollen = true;
chat_search_btn.addEventListener("click",()=>{
    if(search_bollen){
        serach_item.classList.add("active");
        search_bollen = false;
    } else {
        serach_item.classList.remove("active");
        search_bollen = true;
    }
})
const person_name = document.querySelectorAll(".person_user");

const search_clear = document.querySelector(".search_clear"),
search_input = document.querySelector(".search_input");
search_input.addEventListener("input",(e)=>{
    if(e.target.value == ""){
        search_clear.classList.remove("active");
    }else{
        search_clear.classList.add("active");

    }

    person_name.forEach((person,index)=>{
        console.log(person.textContent);
        console.log(e.target.value.indexOf(person));
        let text = e.target.value.toLowerCase();
        let textS = person.textContent;
        if( textS.toLocaleLowerCase().indexOf(text) !=-1){
            person_name[index].parentElement.parentElement.classList.remove("active");
            console.log(index);
        } else {
            person_name[index].parentElement.parentElement.classList.add("active");

        }
    })

});

search_clear.addEventListener("click",()=>{
    search_input.value = "";
    search_clear.classList.remove("active");
    person_name.forEach((per,i)=>{
        person_name[i].parentElement.parentElement.classList.remove("active");

    })
})

console.log("salom");