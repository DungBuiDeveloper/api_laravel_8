## CSV DOWNLOAD JS 

```
const url = window.URL.createObjectURL(new Blob([response.data])) 
const link = document.createElement('a')
link.href = url
link.setAttribute('download', 'a.csv')
document.body.appendChild(link)
link.click()
```


```
axios(`http://laravel-api.test/api/pdf/articles`, {
    method: 'GET',
    responseType: 'blob' //Force to receive data in a Blob Format
})
.then(response => {
//Create a Blob from the PDF Stream
    const file = new Blob(
        [response.data], 
        {type: 'application/pdf'});
//Build a URL from the file
    const fileURL = URL.createObjectURL(file);
//Open the URL on new Window
    window.open(fileURL);
})
.catch(error => {
    console.log(error);
});
```