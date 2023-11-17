import logo from './logo.svg';
import './App.css';
import Chatbot from "react-chatbot-kit";

import config from "./configs/chatbotConfig";
import MessageParser from "./chatbot/MessageParser";
import ActionProvider from "./chatbot/ActionProvider";

function App() {
  return (
      <div className="App">
        <header className="App-header">
          <Chatbot />
        </header>
      </div>
  );
}

export default App;
