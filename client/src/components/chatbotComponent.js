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
        setUserInput('');
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