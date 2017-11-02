import React, { Component } from 'react';
import {AppRegistry, Text, Image, View,TextInput, ListView,Button,StatusBar} from 'react-native';
import { StackNavigator } from 'react-navigation';
import MainNav from './MainScreenNavigator.js';
var poster = require('./Poster.js');

url = 'www.programminginitiative.com'
var password;
port ='';
key = "no key";
username ="no username"

class LoginPage extends Component {
    constructor(props) {
        super(props);
        this.state = {user: 'Test',password:'123',sessionKey:'not Logged in'};
    }

    static navigationOptions = {
        title: 'Welcome to Gradient',
    };

    Switch2All=function(user,pass) {
        navigate('Chat')
    }

    render() {
        //const {navigate} = this.props.navigate;
        return (
            <View style={{padding: 10}}>
                <Text>Welcome to Gradient</Text>
                <TextInput
                    style={{height: 40}}
                    placeholder="UserName"
                    defaultValue={"Test"}
                    onChangeText={(text) => (this.state.user=text)}
                />
                <TextInput
                    style={{height: 40}}
                    placeholder="password"
                    defaultValue={"123"}
                    onChangeText={(text) => (this.state.password = text)}
                />
                <Button title={"login"}
                        color={"#ae59f3"}
                        onPress={()=>{
                            username = this.state.user;
                            const {navigate} = this.props.navigation;
                            poster.Login(this.state.user,this.state.password)
                                .then(function(result){
                                    if(result._bodyInit !="Incorrect username/password") {
                                        key = JSON.parse(result._bodyInit).session_id
                                        navigate("Main")
                                    }else{
                                        console.warn("incorrect user or password")//change this later
                                    }
                                })
                        }
                        }/>
                <Button title={"SignUp"}
                        color={"#8b00f3"}
                        onPress={()=>{
                            username = this.state.user;
                            const {navigate} = this.props.navigation;
                            navigate('Signup')
                        }
                        }/>
                <Text>{(this.state.sessionKey).toString()}</Text>

            </View>
        );
    }
}

class SignUp extends Component{
    constructor(props) {
        super(props);
        this.state = {user: 'Test',password:'123',sessionKey:'not Logged in'};
    }


    render(){
        //signup
        return(
            <View style={{padding: 10}}>
                <Text>SignUp</Text>
                <TextInput
                    style={{height: 40}}
                    placeholder="UserName"
                    defaultValue={"Test"}
                    onChangeText={(text) => (this.state.user=text)}
                />
                <TextInput
                    style={{height: 40}}
                    placeholder="password"
                    defaultValue={"123"}
                    onChangeText={(text) => (this.state.password = text)}
                />
                <Button title={"Signup"}
                        color={"#ae59f3"}
                        onPress={()=>{
                            username = this.state.user;
                            const {navigate} = this.props.navigation;
                            poster.SignUp(this.state.user,this.state.password);
                            poster.Login(this.state.user,this.state.password)
                                .then(function(result){
                                    if(result._bodyInit !="Incorrect username/password") {
                                        key = JSON.parse(result._bodyInit).session_id
                                        navigate("Main")
                                    }else{
                                        console.warn("incorrect user or password")//change this later
                                    }
                                })
                        }
                        }/>
                <Text>{(this.state.sessionKey).toString()}</Text>

            </View>
        )
    }
}

function start(navigate){
    poster.AllPage(key)
        .then(function (result) {
            return result._bodyInit
        })
        .then(function (result) {
            return JSON.parse(result)
        })
        .then(function(result){
            posts = result
        })
        .then(function () {
            navigate('Main')
        })
}

const SimpleApp = StackNavigator({
    Home: { screen: LoginPage },
    Signup: {screen: SignUp},
    Main: { screen: MainNav },
    },
    { headerMode: 'none' }
)

module.exports = SimpleApp;

// skip this line if using Create React Native App
AppRegistry.registerComponent('AwesomeProject', () => SimpleApp);