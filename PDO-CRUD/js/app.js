// document.addEventListener("DOMContentLoaded", function(event) {

    const formulario = document.querySelector('#formulario');

    formulario.addEventListener('submit', (e) => {
        e.preventDefault();
        const datos = new FormData(formulario);
        const url = './server/insert.php';
        fetch(url,{
            method:'POST',
            body:datos
        })
            .then( data => data.json())
            .then( data => {
                formulario.reset();
                tablaResponse(data);
            })
            .catch((e)=>{
                console.log(e);
            })
    });

    const tablaResponse = (data) =>{
            const tableDoc = document.querySelector('#table');
            tableDoc.innerHTML = "";
            for(let dato of data){
                tableDoc.innerHTML += `
                
                    <td>${dato.id}</td>
                    <td>${dato.nombre}</td>
                    <td>${dato.apellidos}</td>
                    <td>${dato.sexo}</td>
                    <td>
                        <button type="submit" class="btn btn-primary" onclick="editar(${dato.id}, 300,'edit')">Editar</button>
                        <button type="submit" class="btn btn-danger" onclick="editar(${dato.id}, 300, 'delete')">Eliminar</button>
                    </td>
                `
            }

    }

   const editar = (id, width, func) => {
        const datos = new FormData();
        datos.append('id',id);
        const url = './server/edit.php';
        fetch(url, {
            method: 'POST',
            body: datos
        })
            .then( data => data.json() )
            .then( data => {
               console.log(data);
               modal(data, width, func);
            })
            .catch((e)=>{
                console.log(e);
            })
   }

   const eliminar = (id) => {
    const formDelete = document.querySelector('#deleteUser');
    formDelete.addEventListener('submit', (e) => {
        e.preventDefault();
        const datos = new FormData(formDelete);
        datos.append('id',id);
        const url = './server/delete.php';
        fetch(url, {
            method: 'POST',
            body: datos
        })
            .then( data => data.json() )
            .then( data => {
               console.log(data);
               tablaResponse(data);
               formulario.reset();
               cerrar();
            })
            .catch((e)=>{
                console.log(e);
            })
    })
    
}

   const modal = (data, width, option) => {
       let divPadre = document.createElement('div');
       divPadre.className ='divPadre';
       divPadre.id='divPadre';

       let divHijo = document.createElement('div');
       divHijo.className ='divHijo';
       divHijo.style.width = width+"px";

       document.body.appendChild(divPadre);
       divPadre.appendChild(divHijo);

        for(let dato of data){
            if(option == 'edit'){
                let sex = dato.sexo;
                let otroSex = '';
                if(sex == 'Masculino' ){                
                    otroSex = 'Femenino'
                }else{               
                    otroSex = "Femenino"
                }
                divHijo.innerHTML = `
                <form action="" id="form_edit">
                    <input type="hidden" name="id" value="${dato.id}" id="">
                    <input type="text" name="nombre" placeholder="Nombre" value="${dato.nombre}" id="">
                    <input type="text" name="apellidos" placeholder="Apellidos" value="${dato.apellidos}" id="">
                    <select name="sexo">
                        <option value="">Seleccione una opcion</option>
                        <option value="${sex}" selected>${sex}</option>
                        <option value="${otroSex}">${otroSex}</option>
                    </select>
                    <div>
                    <button class="btn btn-primary" onclick="update()">Aceptar</button>
                    <button class="btn btn-primary" onclick="cerrar()">Cancelar</button>
                    </div>
                </form>
                `
            }else{
                divHijo.innerHTML = `
                    <h2>Desea eliminar a ${dato.nombre} ${dato.apellidos}? </h2>
                    <form id="deleteUser">
                    <input type="submit" class="btn btn-primary" onclick="eliminar(${dato.id})" value="Eliminar">
                    <button class="btn btn-primary" onclick="cerrar()">Cancelar</button>
                    </form>
                `
            }
        }

   }

const update = ()=>{
   const form_edit = document.querySelector('#form_edit');
   form_edit.addEventListener('submit', (e) => {
        e.preventDefault();
        const datos = new FormData(form_edit);
        const url = './server/update.php';
        fetch(url, {
            method: 'POST',
            body: datos
        })
            .then( data => data.json() )
            .then( data => {
                console.log(data)
                formulario.reset();
                tablaResponse(data);
                cerrar();
            })
            .catch((e)=>{
                console.log(e);
            })
   })
}



const cerrar = ()=>{
    const divPadre = document.querySelector('#divPadre');
    document.body.removeChild(divPadre);
}
// });