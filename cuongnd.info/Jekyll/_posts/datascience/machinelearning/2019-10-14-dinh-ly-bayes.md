---
title: Định lý Bayes (Bayes' Theorem)
categories: [data_science, ml]
tags: [Bayes,Theorem]
maths: 1
toc: 1
datacamp: 1
date: 2019-10-14
---

{% include toc.html %}

Định lý Bayes (Bayes’ Theorem) là một định lý toán học để tính xác suất xảy ra của một sự kiện ngẫu nhiên A khi biết sự kiện liên quan B đã xảy ra.

Định lý này đặt theo tên nhà toán học Thomas Bayes, người Anh sống ở thế kỷ 18. Đây là một trong những công cụ vô cùng hữu ích, người bạn thân của các Data Scientist, những người làm trong ngành khoa học dữ liệu.

## Xác suất có điều kiện

Ta có 2 sự kiện ngẫu nhiên A và B.
Nếu A và B là 2 sự kiện độc lập, ta có xác suất để xảy ra A và B đồng thời là:

$$
\begin{equation}
P(A,B)=P(A)P(B)
\label{eq:bayes}
\tag{1}
\end{equation}
$$

trong đó:
- $$ P(A) $$ là xác suất xảy ra A riêng biệt.
- $$ P(B) $$ là xác suất xảy ra B riêng biệt.

Nếu A và B là 2 sự kiện liên quan đến nhau, và xác suất xảy ra sự kiện B lớn hơn 0, ta có thể định nghĩa xác suất xảy ra AA khi biết BB xảy ra như sau:

$$ P(A∣B)= \frac{P(A,B)}{P(B)} $$

Ta có thể viết lại thành:

$$ P(A,B)=P(A∣B)P(B) $$

> Khi A và B là 2 sự kiện độc lập ta có $$ P(A|B) = P(A)P(A∣B)=P(A) $$, ta thu được công thức như $\eqref{eq:bayes}$.
​

### Ví dụ

Một gia đình có 2 đứa trẻ. Biết rằng có ít nhất 1 đứa trẻ là con gái. Hỏi xác suất 2 đứa trẻ đều là con gái là bao nhiêu?

Hiểu rằng:

- Xác suất để một đứa trẻ là trai hoặc gái là bằng nhau và bằng $$ 1\Big/2 $$.
- Giới tính cả 2 đứa trẻ là ngẫu nhiên và không liên quan đến nhau.

### Giải

Do gia đình có 2 đứa trẻ nên sẽ có thể xảy ra 4 khả năng: (trai, trai), (gái, gái), (gái, trai), (trai, gái).

Ký hiệu |   Sự kiện |   Xác suất
B  |   Ít nhất 1 đứa trẻ là con gái    |   $$ \dfrac {3}{4} $$
A  |   Cả 2 đứa trẻ đều là con gái |   $$ \dfrac {1}{4} $$

Do nếu xảy ra A thì đương nhiên sẽ xảy ra B nên ta có: $$ P(A,B) = P(A) = 1 / 4 $$

Lắp vào công thức trên ta có:

$$ P(A∣B)= \frac{P(A,B)}{P(B)}=\frac {\frac{1}{4}}{\frac{3}{4}} = \frac{1}{3} $$

> Bằng trực quan ta cũng có thể nhìn ra xác suất này. Khi biết một đứa trẻ là gái, giới tính của 2 đứa trẻ sẽ có 3 khả năng: (trai, gái), (gái, trai), (gái, gái).

## Định lý Bayes

Định lý Bayes dựa trên định nghĩa về xác suất có điều kiện ở trên, được phát biểu dưới dạng công thức như sau:

$$ P(A∣B)= \frac{P(B|A)P(A)}{P(B)} $$

Kí hiệu $$ \neg {A} $$ là không $$ A $$ (hay bù $$ A $$). Ta có $$ P(A) + P(\neg {A}) = 1 $$.

Từ đó:

$$ P(B) = P (B,A) + P(B,\neg{A}) = P(B|A)P(A) + P(B|\neg{A})P(\neg{A}) $$

Định lý Bayes được viết dưới dạng biến thể như sau:

$$
    P(A|B) = \frac{P(B|A)P(A)}{P(B|A)P(A) + P(B|\neg{A})P(\neg{A})}
$$

## Bài toán Tuesday Child

Đây là một bài toán khá nổi tiếng trong xác suất thống kê, được giải theo nhiều cách khác nhau. Ta hãy thử giải bài toán này bằng định lý Bayes.

### Bài toán

Vẫn là gia đình có 2 đứa trẻ như ví dụ 1. Biết có ít nhất có một đứa trẻ là con gái và sinh vào thứ 3. Hỏi xác suất 2 đứa trẻ đều là con gái là bao nhiêu?

Hiểu rằng:
- Xác suất để một đứa trẻ sinh vào một ngày nhất định trong tuần là $$ 1 \Big/ 7 $$.
- Giới tính của đứa trẻ và ngày sinh của nó là 2 sự kiện không liên quan đến nhau.

### Giải

Thoạt nhìn ta dễ tưởng giới tính và ngày sinh của đứa trẻ là 2 sự kiện không liên quan đến nhau, nên ta sẽ thu được kết quả như ví dụ 1. Tưởng vậy mà không phải vậy…

Ta ký hiệu các sự kiện như sau:

|Ký hiệu |   Sự kiện |   Xác suất|
|---|---|---|---|
|$$ B $$  |   Ít nhất 1 đứa trẻ là con gái sinh ra vào thứ 3  |   ?|
|$$ A $$  |   Cả 2 đứa trẻ đều là con gái |   $$ \frac{1}{4} $$|
|$$ A_1 $$   |   Chỉ một trong 2 đứa trẻ là con gái  |   $$ \frac{1}{2} $$|
|$$ C $$  |   Đứa trẻ sinh ra vào thứ 3   |   $$ \frac{1}{7} $$|
|$$ \neg {C} $$  |   Đứa trẻ không sinh ra vào thứ 3 |   $$ \frac{6}{7} $$|


Để sử dụng định lý Bayes tính $$P(A∣B)$$ ta cần tính được $$P(B∣A)$$ và $$P(B)$$.

$$ P(B∣A) $$ được hiểu là xác suất ít nhất 1 đứa trẻ là con gái sinh ra vào thứ 3 nếu biết trước 2 đứa trẻ là con gái.
Ta sẽ tính xác suất phần bù $$ P(\neg{B}∣A) $$ là xác suất để không có đứa trẻ nào sinh ra vào thứ 3.

$$ P(\neg{B}|A) = P(\neg{C})P(\neg{C}) = \frac{6}{7} \times \frac{6}{7} = \frac{36}{49}) $$

Vậy ta có

$$ P(A|B)=1-P(\neg{B}|A)=\frac{13}{49} $$

$$P(B)$$ là xác suất sự ít nhất 1 đứa trẻ là con gái sinh ra vào thứ 3.
Sự kiện này bao gồm 2 khả năng:
* Cả 2 đứa trẻ đều là con gái $$(A)$$
* Chỉ 1 đứa trẻ là con gái $$(A_1)$$

Ta có

$$
\begin{align*}
P(B) &=               P(B,A)+P(B,A_{1}) \\
P(B) &=       P(B|A)P(A) + P(B|A_1)P(A_1) \\
P(B) &=   \frac{13}{49} \times \frac{1}{4} + \frac{1}{7} \times \frac{1}{2} \\
P(B) &=           \frac{27}{196} \\
\end{align*}
$$

Thay vào định lý Bayes, ta tính được

$$ P(A|B)=\frac{P(B|A)P(A)}{P(B)}=\frac{\frac{13}{49} \times \frac{1}{4} }{\frac{27}{196}} = \frac{13}{27} \approx 0.481 $$

## Kiểm tra

Ta dùng một đoạn code Python nho nhỏ để kiểm tra thử kết quả vừa tính được.

~~~  {% raw %}
import random

def random_kid():
    gender = random.choice(["boy", "girl"])
    birth_date = random.choice(["mon", "tue", "wed", "thu", "fri", "sat", "sun"])
    return (gender, birth_date)


both_girls = 0
tuesday_girl = 0

random.seed(0)
total = 100000
for _ in range(total):
    first_child = random_kid()
    second_child = random_kid()

    if first_child == ("girl", "tue") or second_child == ("girl", "tue"):
        tuesday_girl += 1
        if first_child[0] == "girl" and second_child[0] == "girl":
            both_girls += 1

print("both_girls = ", both_girls)
print("tuesday_girl = ", tuesday_girl)
print("P(both_girls|tuesday_girl) = ", both_girls / tuesday_girl)
{% endraw %} ~~~

Đoạn code trên thực hiện random 100K dữ liệu.

~~~  {% raw %}
both_girls =  6506
tuesday_girl =  13637
P(both_girls|tuesday_girl) =  0.4770844027278727
{% endraw %} ~~~

Xác suất tính ra tương đối sát với con số ta tính bằng định lý Bayes ở trên.


Nguồn <a href="https://1upnote.me/post/2018/11/ds-ml-naive-bayes/">https://1upnote.me/post/2018/11/ds-ml-naive-bayes/</a>