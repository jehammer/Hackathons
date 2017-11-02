import React from 'react';
import {Text, View,Button, ScrollView, StyleSheet} from 'react-native';
//import styles from './StyleSheet';
import LinearGradient from 'react-native-linear-gradient';
import GeolocationExample from "./GeoLocation";
var geo = require('./GeoLocation.js');
var Post = require('./Gradient.js')
var poster = require('./Poster.js')
var Color = require('color');
//mainPage = require('./mainPage')


class Profile extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            results:[{
                key:1,
                title: 'null',
            }]};
        getAllPost(this)
    }

    render() {
        //console.disableYellowBox = true; //TERIBLE SOLUTION, PLEASE FOR THE LOVE OF GOOD CODING PRACTICES FIND A BETTER SOLUTION!
        const renderedPosts =  this.state.results.map(b => {
            var color = "#4286f4"
            return (
                <View key={b.key}>
                    <Post color1={String(Color(b.colorA))} color2={String(Color(b.colorB))} text = {b.text}/>
                </View>
            )
        });
        return (
            <View>
                <LinearGradient colors={['#30ffa6', '#ffd31f']}>
                    <Text>profile</Text>
                    <GeolocationExample/>
                </LinearGradient>
            <ScrollView>
                {renderedPosts}
            </ScrollView>
            </View>
        )

    }
}


function getAllPost(_this){
    data = {
        key:key,
        username:username,
    };
    poster.GetAllPost()
        .then(function (result) {
            return result._bodyInit
        })
        .then(function (result) {
            //split strings here
            var res = result.split('');
            var starts = [];
            var ends = [];
            for(var i =2; i<res.length-1;i++){
                if(res[i]==='{'){
                    starts.push(i);
                }
                if(res[i]==='}'){
                    ends.push(i);
                }
            }
            var allJson = [];

            for(i = 0; i<ends.length;i++){
                //console.warn(result.substring(starts[i],ends[i]+1))
                allJson.push(JSON.parse(result.substring(starts[i],ends[i]+1)))
                allJson[i].colorA = allJson[i].colorA.toLowerCase();
                allJson[i].colorB = allJson[i].colorB.toLowerCase();
                allJson[i].key = i;
            }

            //console.warn(allJson[2].colorA)

            _this.setState({results:allJson})
        })
        .catch(function (err) {
            console.warn("I guess there was a post request error in profile.js in the getAllPost method "+err)
        })
}

module.exports = Profile;