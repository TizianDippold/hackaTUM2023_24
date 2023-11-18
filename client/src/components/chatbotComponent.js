import {Button} from "@material-tailwind/react";
import MessageComponentBot from "@/components/messageComponentBot";
import MessageComponentUser from "@/components/messageComponentUser";
import React, {useState} from 'react';

export default function ChatbotComponent() {
    const [userInput, setUserInput] = useState('');
    const chatMsgs = ['How can I help you today?']
    let chatId = 1;
    const [chatList, chatSetList] = React.useState(chatMsgs);

    const url = 'https://hackatum23.moremaier.com/api/chat-sessions';


    const fetchChatResponse = async () => {
        try {
            const response = await fetch(`${url}/${chatId}/messages`, {
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

            return await response.json();
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };


    const handleInputChange = (e) => {
        setUserInput(e.target.value);
    };

    const handleButtonClick = async () => {
        console.log('Sending user input:', userInput);
        const newList = chatList.concat(userInput);
        chatSetList(newList);
        console.log("test1: " + chatList);
        const responseData =  await fetchChatResponse(userInput);
        const botMsg = responseData['data']['content'];
        console.log("test2: " + botMsg);
        setUserInput('');

        console.log(chatList);
        const newListBot = chatList.concat(botMsg);
        chatSetList(prevState => {prevState.concat(newListBot)});
        console.log(chatList);

        // if (responseData.chat_session.finalized) {
        //
        // }
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