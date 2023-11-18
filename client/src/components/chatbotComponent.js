import { Button, Input } from "@material-tailwind/react";
import MessageComponentBot from "@/components/messageComponentBot";
import MessageComponentUser from "@/components/messageComponentUser";
import React, { useState } from 'react';
import Image from "next/image";

export default function ChatbotComponent() {
    const [userInput, setUserInput] = useState('');
    const chatMsgs = ['How can I help you today?']
    const [chatList, chatSetList] = React.useState(chatMsgs);

    const handleInputChange = (e) => {
        setUserInput(e.target.value);
    };

    const handleButtonClick = () => {
        console.log('Sending user input:', userInput);
        const newList = chatList.concat(userInput);
        chatSetList(newList);
        console.log(chatList);
        console.log(chatMsgs);
        setUserInput('');
    };

    return (
        <div className="flex flex-col h-screen bg-gray-50">
                <div className="flex items-center justify-between bg-green-400 p-8"></div>
                <div className="flex flex-col space-y-2 p-4">
                    <ul>
                        {chatList.map((element, index) => {
                            if (index % 2 === 0) {
                                return <MessageComponentBot textToDisplay={chatList[index]} />;
                            } else {
                                return <MessageComponentUser textToDisplay={chatList[index]} />;
                            }
                        })}
                    </ul>
                </div>
            <div className="flex items-center bottom-0 bg-gray-200 p-4 absolute bottom-0 w-screen">
                <div className="">
                    <input
                        type="text"
                        value={userInput}
                        onChange={handleInputChange}
                        placeholder="Type your message..."
                        className=""
                    />
                    <Button onClick={handleButtonClick} className="">
                        Send
                    </Button>
                </div>
            </div>
        </div>
    )
}