/**
 * Created by diamondrubix on 6/20/17.
 */
import React, { Component } from 'react';
import {Modal,AppRegistry, Text, Image, View, StyleSheet,TextInput, ListView, Alert,Button,Touchable,ScrollView} from 'react-native';
import { TabNavigator } from "react-navigation";
//sha1 = requir e('sha1');
//var sha1 = require('sha1');
//console.warn(sha1("message"))
var poster = require('./Poster.js');

url = "localhost" //this is temporary

class Post extends React.Component {

    constructor(props) {
        super(props);
        //this.state = {post: '{title:"thing"'};
        this.state = {modalVisible: false, body: 'nothing here'};
        //this.modalVisible = true;
    }
    setModalVisible(visible) {
        this.setState({modalVisible: visible});
    }

    render() {
        return (
            <View>
                <Modal
                    animationType={"slide"}
                    transparent={false}
                    visible={this.state.modalVisible}
                    onRequestClose={() => {this.setModalVisible(!this.state.modalVisible)}}
                >
                    <Button
                        style = {{}}
                        title={'your post as been submited'}
                        color={"#00f355"}
                        onPress={()=>{
                            this.setModalVisible(!this.state.modalVisible)
                        }}

                    >

                    </Button>

                </Modal>
                <View style = {{
                    height: 50,
                    backgroundColor:'#0b03c9',
                    alignItems: 'center',
                }}>
                    <Text style={styles.title}>Create A Post!</Text>
                </View>
                <View style = {{
                    backgroundColor: '#fffdfe',
                }}>

                    <TextInput
                        style={{height: 100}}
                        placeholder="Your Post goes here"
                        defaultValue={""}
                        onChangeText={(text) => (this.state.body=text)}
                    />
                    <Button title={"post"}
                            color={"#ae59f3"}
                            onPress={()=> {
                                this.setModalVisible(!this.state.modalVisible);
                                poster.UploadPost(this.state.body)
                                    .then(function(result){
                                        //console.warn(result._bodyInit)
                                    })
                                    .catch(function(err){
                                        console.warn(err)
                                    })
                            }}/>
                </View>

            </View>

        )
    }
}


const styles = StyleSheet.create({
    title: {
        color: '#fbffff',
        fontWeight: 'bold',
        fontSize: 30,
        justifyContent: 'center'
    },
    content: {
        color: 'black',
        fontSize: 20,
        backgroundColor: '#fbffff',
    },
});

module.exports = Post;