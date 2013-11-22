var myimages=new Array()
function preloadimages(){
for (i=0;i<preloadimages.arguments.length;i++){
myimages[i]=new Image()
myimages[i].src=preloadimages.arguments[i]
}
}

preloadimages("images/header/01-alfombras-hover.gif.jpg","images/header/02-modulares-hover.gif","images/header/03-moquettes-hover.gif" ,"images/header/04-fieltros-hover.gif" ,"images/header/05-pisos-hover.gif" ,"images/header/06-vinilicos-hover.gif")
