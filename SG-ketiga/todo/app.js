const todoField = document.getElementById("todo-field");
const todoAddButton = document.getElementById("todo-add-button");
const todoListContent = document.getElementById("todo-list-content");

let todos = [];

getTodo();

todoAddButton.addEventListener("click", () => {
	const todoValue = todoField.value;
	if (todoValue) {
		todos.push({
			"todo": todoValue,
			"todoStatus": false
		});
		getTodo();
		todoField.value = "";
		todoField.focus();
	}
	else alert("masukan todo");
});

function getTodo() {
	todoListContent.innerHTML = "";

	if (todos.length === 0) {
		const contentElement = /*html*/`
		<tr>
			<td colspan="3">Nothing todo</td>
		</tr>
	`;
		todoListContent.innerHTML += contentElement;
	} else {
		todos.forEach((value, index) => {
			const contentElement = /*html*/`
				<tr>
					<td>${index + 1}</td>
					<td style="text-decoration: ${value.todoStatus ? 'line-through' : 'none'};">${value.todo}</td>
					<td>
						<button class="done-button" data-todo-id="${index}">${value.todoStatus ? 'Mark as undone' : 'Mark as done'}</button>
						<button class="delete-button" data-todo-id="${index}" >delete</button>
					</td>
				</tr>
			`;
			todoListContent.innerHTML += contentElement;
		});

		doneButton();
		deleteButton();
	}
}

function doneButton() {
	const doneButton = document.querySelectorAll(".done-button");

	doneButton.forEach(button => {
		button.addEventListener("click", () => {
			toggleTodo(button.dataset.todoId);
		})
	});
}

function deleteButton() {
	const deleteButton = document.querySelectorAll(".delete-button");

	deleteButton.forEach(button => {
		button.addEventListener("click", () => {
			const confirmation = confirm("Yakin menghapusnya?");
			if (confirmation) deleteTodo(button.dataset.todoId);
		})
	});
}

function deleteTodo(idTodo) {
	todos.splice(idTodo, 1);
	getTodo();
}

function toggleTodo(idTodo) {
	const value = todos[idTodo];
	value.todoStatus = !value.todoStatus;
	getTodo();
}