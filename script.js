const taskInput = document.getElementById("task-field");
const addButton = document.getElementById("save-task");
const taskList = document.getElementById("activity-list");

addButton.addEventListener("click", () => {

    const taskText = taskInput.value.trim();

    if (taskText === "") {
        alert("Silakan masukkan tugas terlebih dahulu!");
        return;
    }

    const listItem = document.createElement("li");

    listItem.className =
        "bg-white/10 backdrop-blur-md border border-white/20 text-white p-4 rounded-xl flex justify-between items-center shadow-lg";

    listItem.innerHTML = `
        <span>${taskText}</span>

        <button class="delete-btn bg-rose-500 hover:bg-rose-600 px-3 py-1 rounded-lg transition">
            ✖
        </button>
    `;

    taskList.appendChild(listItem);

    taskInput.value = "";

    listItem.querySelector(".delete-btn").addEventListener("click", () => {
        listItem.remove();
    });
});