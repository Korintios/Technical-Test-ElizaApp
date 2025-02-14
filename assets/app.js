/**
 * Aplicación de gestión de tareas con conexión a una API.
 * 
 * Permite agregar, eliminar, actualizar y filtrar tareas a través de llamadas a la API.
 */

document.addEventListener('DOMContentLoaded', () => {
    const taskInput = document.querySelector('.task-input');
    const taskList = document.querySelector('.task-list');
    const filterBtns = document.querySelectorAll('.filter-btn');

    // URL base de la API
    const URL = ""; // Ejemplo: http://localhost:3000/technical_test
    
    // Array global de tareas
    let tasks = [];
    let globalFilter = 'all';

    // Cargar tareas al iniciar
    loadTasks();

    /**
     * Obtiene las tareas desde el backend y las renderiza en la lista.
     */
    async function loadTasks() {
        try {
            const response = await fetch(`${URL}/api/tasks.php`);
            tasks = await response.json();
            renderTasks();
        } catch (error) {
            console.error("Error al cargar tareas:", error);
        }
    }

    /**
     * Renderiza la lista de tareas según el filtro seleccionado.
     */
    const renderTasks = () => {
        let filteredTasks = tasks;

        if (globalFilter === 'pending') {
            filteredTasks = tasks.filter(task => !task.completed);
        } else if (globalFilter === 'completed') {
            filteredTasks = tasks.filter(task => task.completed);
        }

        taskList.innerHTML = filteredTasks.length ? '' : '<div class="no-tasks">No tasks found</div>';

        filteredTasks.forEach(task => {
            const li = document.createElement('li');
            li.className = `task-item ${task.completed ? 'completed' : ''}`;
            li.innerHTML = `
                <div class="task-checkbox ${task.completed ? 'checked' : ''}" data-id="${task.id}"></div>
                <span class="task-text">${task.title}</span>
                <div>
                    <button class="task-menu task-menu-edit" data-id="${task.id}"><i class="fa-solid fa-pen"></i></button>
                    <button class="task-menu task-menu-delete" data-id="${task.id}"><i class="fa-solid fa-trash"></i></button>
                </div>
            `;
            taskList.appendChild(li);
        });
    };

    /**
     * Agrega una nueva tarea a la lista y la API.
     */
    taskInput.addEventListener('keyup', async (e) => {
        if (e.key === 'Enter' && taskInput.value.trim() !== '') {
            const newTask = { title: taskInput.value.trim() };

            try {
                const response = await fetch(`${URL}/api/add.php`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(newTask)
                });
                const data = await response.json();
                tasks.push(data);
                renderTasks();
                taskInput.value = '';
            } catch (error) {
                console.error("Error in add task:", error);
            }
        }
    });

    /**
     * Maneja los eventos de clic en la lista de tareas (completar, editar, eliminar).
     */
    taskList.addEventListener('click', async (e) => {
        const taskId = Number(e.target.dataset.id);
        // Marcar tarea como completada o pendiente
        if (e.target.classList.contains('task-checkbox')) {
            const task = tasks.find(t => t.id === taskId);
            if (task) {
                try {
                    await fetch(`${URL}/api/complete.php`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id: taskId })
                    });
                    task.completed = !task.completed;
                    renderTasks();
                } catch (error) {
                    console.error("Error in complete task:", error);
                }
            }
        }

        // Eliminar tarea
        if (e.target.classList.contains('task-menu-delete')) {
            if (confirm('¿Do you want to delete this task?')) {
                try {
                    await fetch(`${URL}/api/delete.php`, {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id: taskId })
                    });
                    tasks = tasks.filter(t => t.id !== taskId);
                    renderTasks();
                } catch (error) {
                    console.error("Error in delete task:", error);
                }
            }
        }

        // Editar tarea
        if (e.target.classList.contains('task-menu-edit')) {
            const task = tasks.find(t => t.id === taskId);
            if (task) {
                const newTitle = prompt('Edit task:', task.title);
                if (newTitle !== null) {
                    try {
                        await fetch(`${URL}/api/update.php`, {
                            method: 'PUT',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ id: taskId, title: newTitle })
                        });
                        task.title = newTitle;
                        renderTasks();
                    } catch (error) {
                        console.error("Error in update task:", error);
                    }
                }
            }
        }
    });

    /**
     * Maneja los filtros de tareas (todas, completadas, pendientes).
     */
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            globalFilter = btn.dataset.filter;
            renderTasks();
        });
    });

    // Renderizar tareas iniciales
    renderTasks();
});
