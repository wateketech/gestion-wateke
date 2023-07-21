import { questionModals } from './const.js';

window.addEventListener('help-address-lines', function($event){
  questionModals.fire({
    title: '<p class="h4"><i class="fas fa-map-marker-alt"></i> &nbsp; Lineas de Dirección</p>',
    html: '\
    Hemos decidido hacer las direcciones de esta forma ya que de esta forma podemos almacenarlas para cualquier pais y sus diferentes formas de hacerlo \
    cada linea representa un juego de etiqueta <=> valor de la misma\
    donde la etiqueta es lo que representa en la direccion,\
    donde el valor representa el valor de esa etiqueta\
    Ejemplo: Etiqueta: Calle , Valor: NombreCalle\
    Ejemplo: Etiqueta: Numero , Valor: numero de casa\
    Ejemplo: Etiqueta: Apartamento , Valor: numero del apartamento\
    Ejemplo: Etiqueta: entre , Valor: entre calles\
    Ejemplo: Etiqueta: kilometro , Valor: kilometro\
    \
    en cado de que su pais, provincia o ciudad no se encuentre puede escribirla en una de las linea de dirección\
    Ejemplo: Etiqueta: Ciudad , Valor: NombreCiudad\
    \
    \
    ves que facil es todo, y de esta forma nos permite tener mas control y eficiencia en nuestro servicio\
    \
    \
    \
    \
    ',

    // footer: 'hola'
    // Hemos decidido hacer las direcciones de esta forma ya que de esta forma podemos almacenarlas para cualquier pais y sus diferentes formas de hacerlo \
    // cada linea representa un juego de etiqueta <=> valor de la misma\
    // donde la etiqueta es lo que representa en la direccion,\
    // donde el valor representa el valor de esa etiqueta\
    // Ejemplo: Etiqueta: Calle , Valor: NombreCalle\
    // Ejemplo: Etiqueta: Numero , Valor: numero de casa\
    // Ejemplo: Etiqueta: Apartamento , Valor: numero del apartamento\
    // Ejemplo: Etiqueta: entre , Valor: entre calles\
    // Ejemplo: Etiqueta: kilometro , Valor: kilometro\
    // \
    // en cado de que su pais, provincia o ciudad no se encuentre puede escribirla en una de las linea de dirección\
    // Ejemplo: Etiqueta: Ciudad , Valor: NombreCiudad\
    // \
    // \
    // ves que facil es todo, y de esta forma nos permite tener mas control y eficiencia en nuestro servicio\
    // \
})
});




