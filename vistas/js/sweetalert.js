const DeletedArchive = (url) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = url;
        }
      })
}
const Campo = async (url) => {
  const { value: name } = await Swal.fire({
    title: 'Nombre del formato',
    input: 'text',
    inputPlaceholder: 'Introduce el nombre'
  })
  
  if (name) {
    Swal.fire(`Entered email: ${name}`)
  }
}
