<template lang="pug">
.five.wide.column.ay
  .sixteen.wide.column.yo
    img(src="./logo.png")
  h2 Categories
  .ui.list
    .item.clickable
      router-link(to="/main/text")
        a.ui.grey.empty.circular.label
        span TEXT
    .item.clickable
      router-link(to="/main/sound")
        a.ui.orange.empty.circular.label
        span SOUND
    .item.clickable
      router-link(to="/something")
      a.ui.blue.empty.circular.label
      span SOMETHING    
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Raleway:300,400');
* {
    color: #8F9497;
}

img {
    width: 50%;
    padding-top: 10px;
}
h2 {
      margin-top: 20px;
  margin-left: 15px;
  font-family: 'Raleway', sans-serif;
  font-weight: 400;
  font-size: 2rem;
  text-transform: uppercase;
}
div.item.clickable {
    height: 30px;
}
h1 {
    font-family: 'Raleway', sans-serif;
    font-weight: 300;
    padding-top: 20px;
    margin: 0px 0 20px 0;
}

.yo {
    background-color: #4A5557;
    height: 13%;
}

.ay {
    background-color: #353E43;
    padding: 0!important;
    
}
</style>