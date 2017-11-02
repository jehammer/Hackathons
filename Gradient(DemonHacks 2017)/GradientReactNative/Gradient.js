import React, { Component } from 'react';
import { AppRegistry, View, ScrollView, StyleSheet, Text, TouchableHighlight, Modal, Button } from 'react-native';
import LinearGradient from 'react-native-linear-gradient';
import PostInfo from './PostInfo.js';

class Post extends Component{
    constructor(props) {
        super(props);
        this.state = {modalVisible: false, user: "noUser", text: "no text", color: "figure this out"}
    }

    onPressButton(){
        console.warn("this worked");
    }
    setModalVisible(visible) {
        this.setState({modalVisible: visible});
    }

    render(){
        return(
            <View>
                <Modal
                    animationType={"slide"}
                    transparent={false}
                    visible={this.state.modalVisible}
                    onRequestClose={() => {this.setModalVisible(!this.state.modalVisible)}}
                >
                    <View>
                        <Button
                            style = {{}}
                            title={'back to other gradients'}
                            color={"#00f355"}
                            onPress={()=>{
                                this.setModalVisible(!this.state.modalVisible)
                            }}/>
                        <PostInfo color1={this.props.color1} color2={this.props.color2} author = {this.props.author}/>
                    </View>
                </Modal>
                <TouchableHighlight onPress={()=>{
                    this.setModalVisible()
                }}>
                    <LinearGradient style={{width: 600, height: 234}} colors={[this.props.color1, this.props.color2]} start={{ x: 0, y: 1 }} end={{ x: 1, y: 0 }}>
                        <Text style={{fontSize: 18, color: 'white' , textAlign: 'left', margin: 100,width:400}}>
                            {this.props.text}
                        </Text>
                    </LinearGradient>
                </TouchableHighlight>
            </View>
        )
    }
}


module.exports = Post;