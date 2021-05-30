document.querySelector(".jobs").addEventListener("click", handleJobs)
document.querySelector(".add-job").addEventListener("click", addJobs)
document.querySelector(".input-add-job").addEventListener("keypress", onEnter)
document.querySelector(".clear-jobs").addEventListener("click", clearJobs)


// Check the box OR delete a job

function handleJobs(e) {
    if (e.target.classList.contains("del-job")) {
        e.target.parentNode.remove()
    }

    if (e.target.classList.contains("checkbox")) {
        if (e.target.checked) {
            e.target.parentNode.classList.add("done")
        } else {
            e.target.parentNode.classList.remove("done")
        }
    }
}


// Clear all items

function clearJobs() {
    let jobs = document.querySelector(".jobs")
    while (jobs.firstChild) jobs.removeChild(jobs.firstChild)
}


// Add new items

function addJobs() {
    let value = document.querySelector(".input-add-job").value
    value = escapeHtml(value)
    let jobs = document.querySelector(".jobs")
    if (value === "") {
        alert("請輸入待辦事項")
        return false
    }
    const li = document.createElement("li")
    li.classList.add("job-item")
    li.innerHTML = `<input type="checkbox" class="checkbox"/><div class="job-name">${value}</div><button class="btn del-job done">刪除</button>`
    jobs.appendChild(li)

    // clear input box

    document.querySelector(".input-add-job").value = ""
}


// helper functions

function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function onEnter(e) {
    if (e.key === 'Enter') document.querySelector(".add-job").click()
}