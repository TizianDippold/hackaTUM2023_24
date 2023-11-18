import { Button, Input } from "@material-tailwind/react";
import MessageComponentBot from "@/components/messageComponentBot";
import MessageComponentUser from "@/components/messageComponentUser";
import React, {useEffect, useState} from 'react';
import Image from "next/image";
import {fetch} from "next/dist/compiled/@edge-runtime/primitives";

export default function ChatbotComponent() {
    const [userInput, setUserInput] = useState('');
    const chatMsgs = ['How can I help you today?']
    let botMsg = '';
    let chatId = 0;
    const [chatList, chatSetList] = React.useState(chatMsgs);

    const url = 'https://hackatum23.moremaier.com/api/chat-sessions/'

    useEffect(() => {
        const fetchData = async () => {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-type": "application/json; charset=UTF-8"
                }
            });
        };

        fetchData();
    }, []);

    const fetchChatResponse = async () => {
        try {
            const response = await fetch('{url}/', {
                method: "POST",
                body: JSON.stringify({
                    message: userInput,
                }),
                headers: {
                    "Content-type": "application/json; charset=UTF-8"
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const chatbotAnswerData = await response.json();
            return chatbotAnswerData.data.content;
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };


    const handleInputChange = (e) => {
        setUserInput(e.target.value);
    };

    const handleButtonClick = () => {
        console.log('Sending user input:', userInput);
        const newList = chatList.concat(userInput);
        chatSetList(newList);
        botMsg = fetchChatResponse(userInput);
        setUserInput('');

        chatList.concat(botMsg);
        console.log(chatList);
    };

    return (
        <>
            <div className="flex flex-col h-screen bg-gray-50">
                    <div className="flex items-center justify-between bg-green-400 p-8"></div>
                    <div className="flex flex-col space-y-2 p-4">
                        <ul>
                            {chatList.map((element, index) => {
                                if (index % 2 === 0) {
                                    return <MessageComponentBot key={`bot-${index}`} textToDisplay={element} />;
                                } else {
                                    return <MessageComponentUser key={`user-${index}`} textToDisplay={element} />;
                                }
                            })}
                        </ul>
                    </div>
            </div>
            <div className="flex items-center justify-end bg-gray-200 p-4 absolute bottom-0 w-screen">
                <div className="">
                    <input
                        type="text"
                        value={userInput}
                        onChange={handleInputChange}
                        placeholder="Food..."
                        className="bg-gray-200 px-2 py-1 mr-14"
                    />

                    <Button onClick={handleButtonClick} className="right-1">
                        Send
                    </Button>
                </div>
            </div>
        </>
    )
}