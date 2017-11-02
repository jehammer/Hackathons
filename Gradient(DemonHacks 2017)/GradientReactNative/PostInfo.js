import React, { Component } from 'react';
import {AppRegistry, Text,Touchable, View,Button, StyleSheet} from 'react-native';
import LinearGradient from 'react-native-linear-gradient';


class PostInfo extends Component{
    constructor(props) {
        super(props);
        this.state = {user: "noUser", text: "no text", color: "figure this out"}
    }

    onPressButton(){
        console.warn("this worked");
    }


    render(){
        return(
            <View>
                <LinearGradient style={{width: 600, height: 900}} colors={[this.props.color1, this.props.color2]} start={{ x: 0, y: 1 }} end={{ x: 1, y: 0 }}>
                    <Text style={{color: 'white',fontSize: 18, textAlign: 'left', margin: 100,width:400}}>
                        This post was made by {this.props.author}
                    </Text>
                </LinearGradient>
            </View>
        )
    }
}


function getAllPost(_this){
    data = {
        key:key,
        username:username,
    };
    poster.GetFeed()
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


module.exports = PostInfo;