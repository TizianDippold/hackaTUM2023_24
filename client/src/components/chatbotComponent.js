import {Button, Input} from "@material-tailwind/react";
import MessageComponentBot from "@/components/messageComponentBot";
import MessageComponentUser from "@/components/messageComponentUser";
import React, { useState } from 'react';
import Image from "next/image";

export default function ChatbotComponent() {

    const [userInput, setUserInput] = useState('');

    const handleInputChange = (e) => {
        setUserInput(e.target.value);
        console.log("hiiii")
    };

    const handleButtonClick = () => {
        // Implement logic to send user input (e.g., API call, dispatching an action, etc.)
        console.log('Sending user input:', userInput);
    };

    return (
        <div className="w-full sm:w-[412px] h-full sm:h-[808px] relative">
            <div className="sm:w-[412px] sm:h-[807px] left-0 top-[1px] absolute bg-white" />
            <div className="sm:w-[412px] sm:h-[79px] left-0 top-0 absolute bg-green-300" />
            <div className="sm:w-[396px] sm:h-[47px] left-[8px] sm:top-[747px] absolute">
                <div className="w-[380px] h-[47px] left-[8px] top-0 absolute bg-gray-200 rounded-[10px] shadow" />
            </div>
            <div className="sm:left-[14px] sm:top-[119px] absolute flex-col justify-start items-start gap-2.5 inline-flex">
                <MessageComponentBot/>
                <MessageComponentUser/>
                <MessageComponentBot/>
                <MessageComponentUser/>
            </div>

            <div className="w-full sm:w-[365px] h-7 left-[20px] bottom-6 absolute flex justify-center items-center">
                <input
                    type="text"
                    value={userInput}
                    onChange={handleInputChange}
                    placeholder="Type your message..."
                    className="w-full h-full px-2 py-1 rounded text-gray-600 bg-transparent border-none"
                />
                <Button onClick={handleButtonClick} className="w-14 h-7 right-0 bottom-0 absolute bg-zinc-300 rounded-[30px]">
                    Send
                </Button>
            </div>
        </div>
    )
}
