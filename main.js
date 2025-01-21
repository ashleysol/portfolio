function moreProjects() {
    let hiddenProjects = document.getElementsByClassName("hidden");
    for (const elem of hiddenProjects){
        elem.classList.remove("hidden");
    }
    document.getElementById("more-div").classList.add("hidden");
}