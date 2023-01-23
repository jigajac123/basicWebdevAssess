const url ="http://localhost:3000/basic-webdev-assessment/api/todo.php/";


function putTodo(todo) {
    // implement your code here

    fetch(url,{
        method:'PUT',
        body: JSON.stringify({
            id:todo.id,
            title:todo.title,
            description:todo.description,
            done:todo.done
        }),
        header:{
            "Content-Type":"Application/json; charset=UTF-8"
        }
    })
    .then(response => response.json())
    .then(json => drawTodos(json))
    .catch(error => showToastMessage('Failed to update todos...'));

}

function postTodo(todo) {
    // implement your code here
    
    fetch(url,{
        method:'POST',
        body: JSON.stringify({
            id:todo.id,
            title:todo.title,
            description:todo.description,
            done:todo.done
        }),
        header:{
            "Content-Type":"Application/json; charset=UTF-8"
        }
    })
    .then(response => response.json())
    .then(json => drawTodos(json))
    .catch(error => showToastMessage('Failed to create todos...'));
   
}

function deleteTodo(todo) {
    // implement your code here
    fetch(url + todo.id, {
        method: 'DELETE',
      })
      .then(response => response.json())
      .then(json => drawTodos(json))
      .catch(error => showToastMessage('Failed to delete todos...'));
   
}

// example using the FETCH API to do a GET request
function getTodos() {
    fetch(url)
    .then(response => response.json())
    .then(json => drawTodos(json))
    .catch(error => showToastMessage('Failed to retrieve todos...'));
}

getTodos();