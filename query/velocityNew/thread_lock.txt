#include <thread>
#include <mutex>
#include <iostream>
#include <vector>


struct Kart {
	int id;
	bool crossed;
	std::string last_time;
};


class TSKartVec {
private:
	std::mutex mu_;
	std::vector<Kart> vec;
	bool var = false;

	void long1() {
		std::cout << "long1" << std::endl;
		std::this_thread::sleep_for(std::chrono::milliseconds(1000));
		long2();
	}
	void long2() {
		std::cout << "long2" << std::endl;
		std::this_thread::sleep_for(std::chrono::milliseconds(1000));
		long3();
	}
	void long3() {
		std::cout << "long3" << std::endl;
		std::this_thread::sleep_for(std::chrono::milliseconds(1000));

	}

public:
	void kartTransaction() {
		std::lock_guard<std::mutex> lock(mu_);
		std::cout << std::this_thread::get_id() << std::endl;
		long1();
	}


	void resetBools() {
		std::lock_guard<std::mutex> lock(mu_);
		std::cout << std::this_thread::get_id() << std::endl;
		std::cout << "resetBools" << std::endl;		
	}

	//std::unique_lock<std::mutex> lock(mu_);

};


void threadCode(TSKartVec &kVec) {
	//std::cout << std::this_thread::get_id() << std::endl;	
	kVec.kartTransaction();
}

void thread2Code(TSKartVec &kVec) {

	while (1) {
		//std::this_thread::sleep_for(std::chrono::milliseconds(1500));
		kVec.resetBools();
		std::this_thread::sleep_for(std::chrono::milliseconds(1000));
	}
	
}


int main()
{
	//std::cout << std::this_thread::get_id << std::endl;
	TSKartVec kVec;

	std::thread t1(thread2Code, std::ref(kVec));
	std::thread t2(thread2Code, std::ref(kVec));
	std::thread t3(threadCode, std::ref(kVec));
	std::thread t4(threadCode, std::ref(kVec));
	std::thread t5(threadCode, std::ref(kVec));

	t1.detach();
	t2.detach();
	t3.detach();
	t4.detach();
	t5.detach();


	std::this_thread::sleep_for(std::chrono::milliseconds(15000));
	return 0;
}