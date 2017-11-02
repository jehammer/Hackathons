import React, { Component } from 'react';
import {AppRegistry, Text, Image, View, StyleSheet,TextInput, ListView, Alert,Button,Touchable,ScrollView} from 'react-native';
import { TabNavigator } from "react-navigation";
import mainPage from './mainPage.js';
import PostPage from './PostPage.js';
import Profile from './Profile.js';
//import socket from './utility/socketManager.js'
var poster = require('./Poster.js');


const MainNav = TabNavigator({
    main: { screen: mainPage },
    PostPage: { screen: PostPage},
    Profile: { screen: Profile },
},  {tabBarOptions: {
    activeTintColor: '#fefdff',
    activeBackgroundColor: '#8e46c9',
    labelStyle: {
        fontSize: 12,
    },
    style: {
        height : 0,
        opacity: 0,
    },
}});


MainNav.navigationOptions = {
    title: 'My Chats',
    screen: 'Profile'

};

module.exports = MainNav